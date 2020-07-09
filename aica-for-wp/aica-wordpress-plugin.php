<?php
/**
* Plugin Name: AICA for wordpress Plugin
* Plugin URI: https://aicalliance.org//
* Description: AICA Appliance for wordpress
* Version: 1.0
* Author: Kaz Noble
* Author URI: http://aicalliance.org//
**/

//session_start();
define( 'AICA_FILE', __FILE__ );

// For Admin backend
function aica_enqueue($hook) {
    // Only add to the edit.php admin page.
    // See WP docs.
    //if ('admin.php' !== $hook) {
    //    return;
    //}
    wp_enqueue_script('aica_admin_script', plugin_dir_url(__FILE__) . 'js/adminscript.js');
}
add_action('admin_enqueue_scripts', 'aica_enqueue');

function aica_admin_menu_func(){
        add_menu_page( 'AICA Admin Menu', 'AICA Admin', 'manage_options', 'test-plugin', 'aica_init' );
}
add_action('admin_menu', 'aica_admin_menu_func');
 
function aica_init(){
	global $wpdb;
	
	// Get current portfolio value
	$currentPortSQL = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'aica_admin WHERE aica_id = 1'));
	
	$html = '';
	$html .= '<div class="mt-5" style="clear:both;margin-top:45px;" >';
	$html .= 'Number of portfolio allowed.<br />';
	$html .= '<input class="form-control" type="text" id="txt_number_of_port" name="txt_number_of_port" value="' . $currentPortSQL[0]->aica_value . '" /><br /><br />';
	$html .= '<button class="btn butt_port_number" >SUBMIT</button>';
	$html .= '<div class="div_portno_status" ></div>';
	$html .= '</div>';
	echo $html;
}

// Initial listed funds
$_SESSION['fund_type'] = 'listedfunds';

// Load the Composer autoload file.
require_once dirname( AICA_FILE ) . '/vendor/autoload.php';

/* Logout link/button */
function logout_link_function()
{
	$content = '<a href="' . wp_logout_url("/") . '">Log out</a>';
	return $content;
}
add_shortcode('logout_link_button', 'logout_link_function');
/* End Logout link/button */

/* Member login button */
function aica_member_button_function() {
	$content = '';
	
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_info = get_userdata($user->ID);
		$content = '<div class="div_welcome_back" >';
		$content .= '<p>Welcome back, ' . $user_info->first_name . ' ' . $user_info->last_name . '!</p>';
		$content .= '<p><a href="/membership-account" >VIEW MY ACCOUNT</a></p>';
		$content .= '<a href="' . wp_logout_url("/") . '">Log out</a>';
		$content .= '</div>';
	}
	else
	{
		$content = '<div class="fusion-button-wrapper"><style type="text/css" scoped="scoped">.fusion-button.button-10 .fusion-button-text, .fusion-button.button-10 i {color:rgba(255,255,255,0.83);}.fusion-button.button-10 {border-width:0px;border-color:rgba(255,255,255,0.83);}.fusion-button.button-10 .fusion-button-icon-divider{border-color:rgba(255,255,255,0.83);}.fusion-button.button-10:hover .fusion-button-text, .fusion-button.button-10:hover i,.fusion-button.button-10:focus .fusion-button-text, .fusion-button.button-10:focus i,.fusion-button.button-10:active .fusion-button-text, .fusion-button.button-10:active{color:#ffffff;}.fusion-button.button-10:hover, .fusion-button.button-10:focus, .fusion-button.button-10:active{border-width:0px;border-color:#ffffff;}.fusion-button.button-10:hover .fusion-button-icon-divider, .fusion-button.button-10:hover .fusion-button-icon-divider, .fusion-button.button-10:active .fusion-button-icon-divider{border-color:#ffffff;}.fusion-button.button-10{background: #36274d;}.fusion-button.button-10:hover,.button-10:focus,.fusion-button.button-10:active{background: #36274d;}.fusion-button.button-10{width:100%;}</style><a class="fusion-button button-flat fusion-button-square button-xlarge button-custom button-10" target="_self" href="/member-centre" ><i class="fa-buromobelexperte fab button-icon-left"></i><span class="fusion-button-text">Members</span></a></div>';
	}
	
	return $content;
}
add_shortcode('aica-member-button', 'aica_member_button_function');
/* End Member login button */

/* Contact Form 7 dynamic */
function pine_dynamic_select_field_values ( $scanned_tag, $replace ) {  
	global $post;
	
	if(!empty($post->ID)) {
		if($post->ID == 1022) {
			global $wpdb;
			
			if ( $scanned_tag['name'] != 'work-country' && $scanned_tag['name'] != 'work-state' )  
				return $scanned_tag;

			if( $scanned_tag['name'] == 'work-country' )
				$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}countries ORDER BY `country_name` ASC");
			if( $scanned_tag['name'] == 'work-state' )
				$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}us_states ORDER BY `state` ASC");	
		  
			if ( ! $result )  
				return $scanned_tag;

			if( $scanned_tag['name'] == 'work-country' )
			{
				foreach ( $result as $row ) {  
					$scanned_tag['raw_values'][] = $row->country_name . '|' . $row->country_name;
				}
			}
			if( $scanned_tag['name'] == 'work-state' )
			{
				foreach ( $result as $row ) {  
					$scanned_tag['raw_values'][] = $row->state . '|' . $row->state;
				}
			}	

			$pipes = new WPCF7_Pipes($scanned_tag['raw_values']);

			$scanned_tag['values'] = $pipes->collect_befores();
			$scanned_tag['pipes'] = $pipes;
		  
			return $scanned_tag;
		} else {
			return $scanned_tag;
		}
	}
}  

add_filter( 'wpcf7_form_tag', 'pine_dynamic_select_field_values', 10, 2);
/* End Contact Form 7 dynamic */

/* Sidebar Search Fund */
function func_sidebar_search_fund() {
	$html = '';
	$html .= '<div ng-app="aicaCtrl" ng-controller="fundCtrl" ng-init="loadFund()" >';
	$html .= '<input type="text" id="fund" name="fund" ng-model="fund" ng-keyup="complete(fund)" placeholder="{{ searchplaceholder }}" />';	
	$html .= '<ul class="list-group"><li class="list-group-item" ng-repeat="funddata in filterFund" ng-click="fillTextbox(funddata)">{{funddata}}</li></ul>';
	$html .= '<input type="hidden" id="hid_ticker" name="hid_ticker" ng-model="hid_ticker" value="" />';
	$html .= '<input type="button" class="wpcf7-form-control wpcf7-submit" id="but_find" name="but_find" ng-click="searchFund()" ng-disabled="disableBtn" ng-show="SearchButton" value="FIND FUND" />';
	$html .= '<input type="hidden" name="g-recaptcha-response" id="hid_cap_token" value="" />';
	$html .= '</div>';
	return $html;
}
add_shortcode('sidebar_search_fund', 'func_sidebar_search_fund');
/* End Sidebar Search Fund */

/* Average CEF Universe Data Table */
function universe_data_table_func() {
	$callRes = callAPI('get', 'https://cefdata.com/api/summary/', '');
	$callRes = json_decode($callRes, true);
	$html_tabs = '<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Table</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="false">Performance Table</a>
				</li>
			</ul>';
	$html = '';		
	$html .= '<div class="tab-content" id="myTabContent">';
	$html .= '<div class="tab-pane div_home active" id="home" role="tabpanel" aria-labelledby="home-tab">';
	$html .= '<div class="div_summary_table" >';
	$html .= '<table class="table table-striped table-responsive" ><thead class="thead-light" ><tr>';
	$html .= '<th></th>';
	$html .= '<th>#Funds</th>';	
	$html .= '<th>Current Disc/Prm</th>';
	$html .= '<th>10 Yr Avg Disc/Prm</th>';
	$html .= '<th>Market Yield</th>';
	$html .= '<th>3 Yr Div Growth</th>';
	$html .= '<th>3 Yr RoC %</th>';	
	$html .= '<th>Leverage</th>';
	$html .= '<th>Net Assets (MM)</th>';
	$html .= '<th>1 Yr Price St. Dev</th>';
	$html .= '<th>3 Yr NAV St. Dev</th>';	
	$html .= '<th>90 Day $ Liquidity (M)</th>';
	$html .= '<th>90 Day Volume Trend</th>';	
	$html .= '<th>90 Day Price/Nav Corr</th>';		
	$html .= '<th>Corr to 12 Sectors Index</th>';	
	$html .= '<th>Beta to S&P 500</th></tr>';		
	$html .= '<tbody>';
	foreach($callRes As $res) {
		$rowLabel = '';
		if($res['id'] == 1)
			$rowLabel = 'US / Global Equity CEFs';
		if($res['id'] == 2)
			$rowLabel = 'Municipal (tax-free) CEFs';
		if($res['id'] == 3)
			$rowLabel = 'Debt Focused BDCs';
		if($res['id'] == 4)
			$rowLabel = 'All Listed CEFs/BDCs';
		if($res['id'] == 5)
			$rowLabel = 'Taxable Bond CEFs';
		if($res['id'] == 6)
			$rowLabel = 'Sector Equity CEFs';		
		$html .= '<tr>';
		$html .= '<td>' . $rowLabel . '</td>';
		$html .= '<td>' . $res['funds'] . '</td>';		
		$html .= '<td>' . $res['discount'] . '%</td>';
		$html .= '<td>' . $res['discount_10yr'] . '%</td>';
		$html .= '<td>' . $res['mk_yield'] . '%</td>';
		$html .= '<td>' . $res['div_growth_3yr'] . '%</td>';
		$html .= '<td>' . $res['roc3yr'] . '%</td>';		
		$html .= '<td>' . $res['leverage'] . '%</td>';
		$html .= '<td>$' . $res['net_assets_m'] . '</td>';
		$html .= '<td>' . $res['price_stdev_1yr'] . '</td>';
		$html .= '<td>' . $res['nav_stdev_3yr'] . '</td>';		
		$html .= '<td>' . $res['liq_90'] . '</td>';	
		$html .= '<td>' . $res['volume_trend'] . '%</td>';	
		$html .= '<td>' . ($rowLabel == 'Debt Focused BDCs' ? 'N/A' : $res['corr_90'] . '%') . '</td>';
		$html .= '<td>' . $res['corr_12'] . '%</td>';
		$html .= '<td>' . $res['two_year_price_beta'] . '</td>';		
		$html .= '</tr>';
		$dataDate = $res['as_of_date'];
	}
	$html .= '</tbody></table><strong>Data as of ' . date('m/d/Y', strtotime($dataDate)) . ' from <a href="http://cefdata.com" target="_blank" >CEFData.com</a></strong></div>';
	$html .= '</div>';
	$html_2 = '';
	$html_2 .= '<div class="tab-pane div_data fade" id="data" role="tabpanel" aria-labelledby="data-tab">';
	$html_2 .= '<div class="div_data_table" >';
	$html_2 .= '<table class="table table-striped table-responsive" ><thead class="thead-light" >';
	$html_2 .= '<tr>';
	$html_2 .= '<th></th>';	
	$html_2 .= '<th colspan="2" >1 Week(%)</th>';	
	$html_2 .= '<th colspan="2" >1 Month(%)</th>';
	$html_2 .= '<th colspan="2" >3 Month(%)</th>';
	$html_2 .= '<th colspan="2" >6 Month(%)</th>';
	$html_2 .= '<th colspan="2" >1 Year(%)</th>';
	$html_2 .= '<th colspan="2" >3 Year(%)</th>';
	$html_2 .= '<th colspan="2" >5 Year(%)</th>';
	$html_2 .= '<th colspan="2" >10 Year(%)</th>';
	$html_2 .= '<th colspan="2" >QTD(%)</th>';
	$html_2 .= '<th colspan="2" >YTD(%)</th>';
	$html_2 .= '</tr>';	
	$html_2 .= '<tr>';
	$html_2 .= '<th></th>';	
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';	
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';
	$html_2 .= '<th>Price</th>';
	$html_2 .= '<th>NAV</th>';	
	$html_2 .= '</tr></thead>';
	$html_2 .= '<tbody>';
	foreach($callRes As $res) {		
		$rowLabel = '';
		if($res['id'] == 1)
			$rowLabel = 'US / Global Equity CEFs';
		if($res['id'] == 2)
			$rowLabel = 'Municipal (tax-free) CEFs';
		if($res['id'] == 3)
			$rowLabel = 'Debt Focused BDCs';
		if($res['id'] == 4)
			$rowLabel = 'All Listed CEFs/BDCs';
		if($res['id'] == 5)
			$rowLabel = 'Taxable Bond CEFs';
		if($res['id'] == 6)
			$rowLabel = 'Sector Equity CEFs';		
		$html_2 .= '<tr>';
		$html_2 .= '<td>' . $rowLabel . '</td>';		
		$html_2 .= '<td>' . $res['one_week_tr_price'] . '%</td>';		
		$html_2 .= '<td>' . $res['one_week_tr_nav'] . '%</td>';
		$html_2 .= '<td>' . $res['one_mo_tr_price'] . '%</td>';
		$html_2 .= '<td>' . $res['one_mo_tr_nav'] . '%</td>';
		$html_2 .= '<td>' . $res['three_mo_tr_price'] . '%</td>';
		$html_2 .= '<td>' . $res['three_mo_tr_nav'] . '%</td>';
		$html_2 .= '<td>' . $res['six_mo_tr_price'] . '%</td>';
		$html_2 .= '<td>' . $res['six_mo_tr_nav'] . '%</td>';
		$html_2 .= '<td>' . $res['one_year_tr_price'] . '%</td>';	
		$html_2 .= '<td>' . $res['one_year_tr_nav'] . '%</td>';	
		$html_2 .= '<td>' . $res['three_year_tr_price'] . '%</td>';	
		$html_2 .= '<td>' . $res['three_year_tr_nav'] . '%</td>';	
		$html_2 .= '<td>' . $res['five_year_tr_price'] . '%</td>';	
		$html_2 .= '<td>' . $res['five_year_tr_nav'] . '%</td>';	
		$html_2 .= '<td>' . $res['ten_year_tr_price'] . '%</td>';	
		$html_2 .= '<td>' . $res['ten_year_tr_nav'] . '%</td>';	
		$html_2 .= '<td>' . $res['qtd_tr_price'] . '%</td>';	
		$html_2 .= '<td>' . $res['qtd_tr_nav'] . '%</td>';	
		$html_2 .= '<td>' . $res['ytd_tr_price'] . '%</td>';	
		$html_2 .= '<td>' . $res['ytd_tr_nav'] . '%</td>';				
		$html_2 .= '</tr>';
		$dataDate = $res['as_of_date'];
	}
	$html_2 .= '</tbody></table><strong>Data as of ' . date('m/d/Y', strtotime($dataDate)) . ' from <a href="http://cefdata.com" target="_blank" >CEFData.com</a></strong></div>';
	$html_2 .= '</div>';	
	$html .= $html_2 . '</div>';
	$_SESSION['data_table'] = $html;
	$_SESSION['performance_table'] = $html_2;
	
	$html .= '<div class="fusion-modal modal fade modal-fluid universe_data" tabindex="-1" role="dialog" aria-labelledby="modal-heading-1" aria-hidden="true" style="display: none;">
				<style type="text/css">.modal-1 .modal-header, .modal-1 .modal-footer{border-color:#ebebeb;}</style>
				<div class="modal-dialog modal-lg">
					<div class="modal-content fusion-modal-content" style="background-color:#e2e2e2">
						<div class="modal-body fusion-clearfix">' . (!empty($_SESSION['universe_data']) ? $_SESSION['universe_data'] : '') . '</div>
					</div>
				</div>
			</div>';	
	
	return $html_tabs . $html;
}
add_shortcode('universe_data_table', 'universe_data_table_func');
/* Average CEF Universe Data Table */

/* Detect user advisor profile if exist */
function func_user_advisor_exist() {
	global $wpdb;
	$html = '';
	
	// Get user details if logged in
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->user_login;
		//$user_info = get_userdata($user->ID);
	}	
	
	$advisor_res = $results = $wpdb->get_results( 
						$wpdb->prepare("SELECT * FROM {$wpdb->prefix}exp_advisors WHERE user_id = %s", $user_id) 
					);
					
	if(!empty($advisor_res)) {
		$html .= '<div class="p-3 mb-2 bg-warning text-dark" >[<a href="/update-experienced-advisor/" >YOU HAVE ALREADY FILLED YOUR ADVISOR PROFILE, CLICK HERE TO EDIT YOUR PROFILE</a>]</div>';
		$html .= '<script>$j = jQuery.noConflict();$j(document).ready(function() {$j(".update_profile_form").hide();});</script>';
	} else {
		$html .= '';
	}
	
	return $html;
}
add_shortcode('user_advisor_exist','func_user_advisor_exist');
/* END Detect user advisor profile if exist */

/* Experienced CEF advisors storage */
function contactform7_before_send_mail( $form_to_DB ) {
	$submission = WPCF7_Submission::get_instance();
	if ( $submission ) {
		$posted_data = $submission->get_posted_data();
	}
	
    global $wpdb;

	if($form_to_DB->id == 1245 || $form_to_DB->id == 8731) {
		$current_user_id = $posted_data['user_id'];
		
		// move uploaded file
		$files = $submission->uploaded_files();

		$destlocation = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $current_user_id;
		if (!file_exists($destlocation)) {
			mkdir($destlocation, 0777, true);
		}
		$logodestlocation = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $current_user_id . '/' . basename($_FILES['logo']['name']);
		$headshotdestlocation = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $current_user_id . '/' . basename($_FILES['headshot']['name']);		
			
		if( copy($files['logo']['tmp_name'], $logodestlocation) ) { 
			// done
		}
		if( copy($files['headshot']['tmp_name'], $headshotdestlocation) ) {
			// done
		}
		
		$table_name = $wpdb->prefix.'exp_advisors';

		/* Custodians get values */
		$custodians_option_str = '';
		if( in_array('Fidelity', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Fidelity:' . $_REQUEST['cust-fidelity'][0] . ',';
		if( in_array('Interactive Brokers', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Interactive Brokers:' . $_REQUEST['cust-ib'][0] . ',';
		if( in_array('LPL', $_REQUEST['custodians']) )
			$custodians_option_str .= 'LPL:' . $_REQUEST['cust-lpl'][0] . ',';
		if( in_array('Merrill Lynch', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Merrill Lynch:' . $_REQUEST['cust-merrill'][0] . ',';		
		if( in_array('Morgan Stanley', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Morgan Stanley:' . $_REQUEST['cust-morgan'][0] . ',';		
		if( in_array('Pershing', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Pershing:' . $_REQUEST['cust-pershing'][0] . ',';		
		if( in_array('Raymond James', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Raymond James:' . $_REQUEST['cust-raymond'][0] . ',';		
		if( in_array('RBC', $_REQUEST['custodians']) )
			$custodians_option_str .= 'RBC:' . $_REQUEST['cust-rbc'][0] . ',';
		if( in_array('Schwab', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Schwab:' . $_REQUEST['cust-schwab'][0] . ',';		
		if( in_array('Stiffel', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Stiffel:' . $_REQUEST['cust-stiffel'][0] . ',';		
		if( in_array('TD Ameritrade', $_REQUEST['custodians']) )
			$custodians_option_str .= 'TD Ameritrade:' . $_REQUEST['cust-td'][0] . ',';		
		if( in_array('UBS', $_REQUEST['custodians']) )
			$custodians_option_str .= 'UBS:' . $_REQUEST['cust-ubs'][0] . ',';				
		if( in_array('Wells Fargo', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Wells Fargo:' . $_REQUEST['cust-wells'][0] . ',';				
		if( in_array('Other', $_REQUEST['custodians']) )
			$custodians_option_str .= 'Other:' . $_REQUEST['cust-other'][0] . ',';

		/* % AUM get values */
		$perc_aum = '';
		if( in_array('Listed CEFs', $posted_data['percent-aum']) )
			$perc_aum .= 'Listed CEFs:' . $posted_data['aum-listedcef'][0] . ',';
		if( in_array('Listed BDCs', $posted_data['percent-aum']) )
			$perc_aum .= 'Listed BDCs:' . $posted_data['aum-listedbdc'][0] . ',';
		if( in_array('Non-listed BDCs', $posted_data['percent-aum']) )
			$perc_aum .= 'Non-listed BDCs:' . $posted_data['aum-nonlistedbdc'][0] . ',';
		if( in_array('Non-listed CEFs (like interval funds)', $posted_data['percent-aum']) )
			$perc_aum .= 'Non-listed CEFs (like interval funds):' . $posted_data['aum-nonlistedcef'][0] . ',';
		
		/* Fund sector values */
		$fund_sec = '';
		if( in_array('U.S. Equity Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'U.S. Equity Funds:' . $posted_data['sec-us-equity'][0] . ',';
		if( in_array('Non U.S. Equity Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Non U.S. Equity Funds:' . $posted_data['sec-nonus-equity'][0] . ',';
		if( in_array('Covered Call Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Covered Call Funds:' . $posted_data['sec-cov-call-funds'][0] . ',';
		if( in_array('Master Limited Partnership Funds (MLPs)', $posted_data['fund-sectors']) )
			$fund_sec .= 'Master Limited Partnership Funds (MLPs):' . $posted_data['sec-master-limit'][0] . ',';
		if( in_array('Real Estate (REIT) Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Real Estate (REIT) Funds:' . $posted_data['sec-real-estate'][0] . ',';
		if( in_array('Preferred Equity Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Preferred Equity Funds:' . $posted_data['sec-preferred-equity'][0] . ',';
		if( in_array('Multisector/Asset Allocation Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Multisector/Asset Allocation Funds:' . $posted_data['sec-multisec-asset'][0] . ',';
		if( in_array('Convertible Bond Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Convertible Bond Funds:' . $posted_data['sec-convert-bond'][0] . ',';
		if( in_array('International Bond Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'International Bond Funds:' . $posted_data['sec-intern-bond'][0] . ',';
		if( in_array('Loan Participation Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Loan Participation Funds:' . $posted_data['sec-loan-parti'][0] . ',';
		if( in_array('High Yield Bond Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'High Yield Bond Funds:' . $posted_data['sec-high-yield'][0] . ',';
		if( in_array('Investment Grade Bond Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Investment Grade Bond Funds:' . $posted_data['sec-invest-grade'][0] . ',';
		if( in_array('Municipal Bond Funds', $posted_data['fund-sectors']) )
			$fund_sec .= 'Municipal Bond Funds:' . $posted_data['sec-muni-bond'][0] . ',';
		if( in_array('Business Development Companies (BDCs)', $posted_data['fund-sectors']) )
			$fund_sec .= 'Business Development Companies (BDCs):' . $posted_data['sec-bus-deve'][0] . ',';
		
		// Get address lat and long
		// Google APIs
		$mapStr = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=' . $posted_data['work-street'] . '%20' . $posted_data['work-city'] . '%20' . $posted_data['work-state'] . '&inputtype=textquery&fields=formatted_address,name,geometry&key=###';
		$mapStr = str_replace(' ','%20',$mapStr);
		$mapres = callAPI('GET', $mapStr, false);
		$mapres = json_decode($mapres,true);
		
		$wpdb->insert( $table_name, array( 'user_id' => $posted_data['user_id'],
											'exp_upload' => $posted_data['logo'],
											'exp_headshot' => $posted_data['headshot'],
											'exp_firstname' => $posted_data['first-name'],
											'exp_lastname' => $posted_data['last-name'],
											'exp_title' => $posted_data['title'],
											'exp_firm' => $posted_data['firm'],
											'exp_prof_des' => $posted_data['professional-designations'],
											'exp_prof_des_2' => $posted_data['professional-designations-2'],
											'exp_prof_des_3' => $posted_data['professional-designations-3'],
											'exp_prof_des_4' => $posted_data['professional-designations-4'],
											'exp_prof_des_5' => $posted_data['professional-designations-5'],
											'exp_prof_des_6' => $posted_data['professional-designations-6'],											
											'exp_crd' => $posted_data['crd'],
											'exp_firm_crd' => $posted_data['firm-crd'],											
											'exp_year_entered' => $posted_data['year-entered-business'],
											'exp_year_started' => $posted_data['year-started'],
											'exp_ad_compensation' => $posted_data['ad-compensation'],
											'exp_hourly_flat' => $posted_data['hourly-flat'][0],
											'exp_custodians' => implode(',',$posted_data['custodians']),
											'exp_cust_other' => $posted_data['cust-other-text'],
											'exp_cust_options' => $custodians_option_str,
											'exp_perc_prac' => $posted_data['percent-practice'],
											'exp_ad_aum' => $posted_data['advisor-aum'],
											'exp_aum_reported' => $posted_data['aum-date'],
											'exp_perc_aum' => implode(',',$posted_data['percent-aum']),
											'exp_per_aum_options' => $perc_aum,
											'exp_fund_sectors' => implode(',',$posted_data['fund-sectors']),
											'exp_fund_sec_options' => $fund_sec,
											'exp_work_street' => $posted_data['work-street'],
											'exp_work_suite' => $posted_data['work-suite'],
											'exp_work_city' => $posted_data['work-city'],
											'exp_work_state' => $posted_data['work-state'],											
											'exp_work_zipcode' => $posted_data['work-zipcode'],
											'exp_lat' => $mapres['candidates'][0]['geometry']['location']['lat'],
											'exp_long' => $mapres['candidates'][0]['geometry']['location']['lng'],
											'exp_work_country' => $posted_data['work-country'],											
											'exp_work_phone' => $posted_data['work-phone'],
											'exp_work_email' => $posted_data['work-email'],
											'exp_company_web' => $posted_data['company-website'],
											'exp_linked' => $posted_data['linkedin'],
											'exp_twitter' => $posted_data['twitter'],
											'exp_hobby' => $posted_data['hobby'],
											'exp_additional_info' => $posted_data['additional-info'],											
											),
									array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s' ) );
									
		if($wpdb->last_error !== '') {
			$str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
			$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
			echo $wpdb->show_errors;
			print "<div id='error'>
			<p class='wpdberror'><strong>WordPress database error:</strong> [$str]<br />
			<code>$query</code></p>
			</div>";
		}
									
	}
}
add_action( 'wpcf7_before_send_mail', 'contactform7_before_send_mail');
/* Experienced CEF advisors storage */

/* Experienced CEF search section */
function experienced_search_func() {
	global $wpdb;
	
	// Get existing listed
	$listedRes = $wpdb->get_results("SELECT exp_prof_des,exp_prof_des_2,exp_prof_des_3,exp_prof_des_4,exp_prof_des_5,exp_prof_des_6 FROM {$wpdb->prefix}exp_advisors");
	$prof_des = [];
	foreach($listedRes As $profdes)
	{
		if( !empty($profdes->exp_prof_des) )
			array_push($prof_des, $profdes->exp_prof_des);
		if( !empty($profdes->exp_prof_des_2) )
			array_push($prof_des, $profdes->exp_prof_des_2);
		if( !empty($profdes->exp_prof_des_3) )
			array_push($prof_des, $profdes->exp_prof_des_3);
		if( !empty($profdes->exp_prof_des_4) )
			array_push($prof_des, $profdes->exp_prof_des_4);
		if( !empty($profdes->exp_prof_des_5) )
			array_push($prof_des, $profdes->exp_prof_des_5);
		if( !empty($profdes->exp_prof_des_6) )
			array_push($prof_des, $profdes->exp_prof_des_6);				
	}
	$prof_des = array_unique($prof_des);
	$htmlProfDes = '';
	foreach($prof_des As $htmlProf)
	{
		$htmlProfDes .= '<option value="' . $htmlProf . '" >' . $htmlProf . '</option>';	
	}
	
	// Get US states
	$statesRes = $wpdb->get_results("SELECT state FROM {$wpdb->prefix}us_states");
	$statesStr = '';
	foreach($statesRes As $state) {
		$statesStr .= '<option value="' . $state->state . '" >' . $state->state . '</option>';
	}
	
	$html = '<div ng-controller="experiencedCtrl" >';
	$html .= '<div class="row" >';
	$html .= '<div class="col-md-3" >Fund Listed<br /><select class="form-control sel_multiple" name="sel_fund_list" id="sel_fund_list" multiple ng-model="sel_fund_list" ng-change="exp_change()" ng-options="fund_list for fund_list in fund_listed" ><option value="" >--select--</option></select></div>';	
	$html .= '<div class="col-md-3" >Professional Designation<br /><select class="form-control sel_multiple" name="sel_prof_des" id="sel_prof_des" multiple ng-model="sel_prof_des" ng-change="exp_change()" ><option value="" >--select--</option>' . $htmlProfDes . '</select></div>';
	$html .= '<div class="col-md-3" >Custodians<br /><select class="form-control sel_multiple" name="sel_cust_list" id="sel_cust_list" multiple ng-model="sel_cust_list" ng-change="cust_change()" ng-options="cust_list for cust_list in custodian_arry" ><option value="" >--select--</option></select></div>';
	$html .= '<div class="col-md-3" >AUM<br /><select class="form-control" name="sel_aum_list" id="sel_aum_list" ng-model="sel_aum_list" ng-change="aum_change()" ng-options="aum.id for aum in aum_array track by aum.val" ><option value="" >--select--</option></select><br />State<br /><select class="form-control" id="sel_state" name="sel_state" ng-model="sel_state" ><option value="" >--select--</option>' . $statesStr . '</select></div>';
	$html .= '</div>';
	$html .= '<div class="row mt-4" >';		
	$html .= '<div class="col-md-2 zipcoderadius" >Zipcode Radius<br /><input type="text" class="form-control" name="txt_zipzode" id="txt_zipcode" placeholder="12345" /></div>';		
	$html .= '<div class="col-md-2 zipcoderadius" >Distance (Mile)<br /><input type="text" class="form-control" name="txt_distance" id="txt_distance" value="10" /></div>';
	$html .= '<div class="col-md-2" ></div>';
	$html .= '<div class="col-md-2" >Min Years in Business<br /><input type="text" class="form-control" name="txt_minyear_list" id="txt_minyear_list" ng-model="txt_minyear_list" placeholder="2001" /></div>';	
	$html .= '<div class="col-md-2" ></div>';
	$html .= '<div class="col-md-2" ></div>';	
	$html .= '</div>';
	$html .= '<div class="row mt-4" >';
	$html .= '<div class="col-md-3" ><button id="but_search" name="but_Search" class="btn btn-primary" ng-click="exp_search()" >SEARCH</button></div>';
	$html .= '<div class="col-md-3" ></div>';
	$html .= '<div class="col-md-3" ></div>';
	$html .= '<div class="col-md-3" ></div>';	
	$html .= '</div>';	
	$html .= '</div>';
	return $html;
}
add_shortcode('experienced_search', 'experienced_search_func');
/* End Experienced CEF search section */

/* Experience CEF advisors list */
function experienced_list_function() {
	global $wpdb;
	
	$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}exp_advisors");
	$html = '<div class="div_experienced_ad_table div_experienced_list" >';
	include(plugin_dir_path(__FILE__).'inc_template/exp_advisors_list.php');
	$html .= '</div>';
	// Display profile
	$html .= '<div class="fusion-modal modal fade modal-1 advisorprofile" tabindex="-1" role="dialog" aria-labelledby="modal-heading-1" aria-hidden="true" style="display: none;">
				<style type="text/css">.modal-1 .modal-header, .modal-1 .modal-footer{border-color:#ebebeb;}</style>
				<div class="modal-dialog modal-lg">
					<div class="modal-content fusion-modal-content" style="background-color:#e2e2e2">
						<div class="modal-header" style="padding-top:0px;padding-bottom:0px;min-height:auto;" ><button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button><h3 class="modal-title" id="modal-heading-1" data-dismiss="modal" aria-hidden="true" data-fontsize="36" data-lineheight="46"></h3></div>
						<div class="modal-body fusion-clearfix">Loading ...</div>
					</div>
				</div>
			</div>';
	
	return $html;
}
add_shortcode('experienced_list', 'experienced_list_function');
/* End Experience CEF advisors list */

/* APIs integrations below */

/* Call API */
function callAPI($method, $url, $data){
   $curl = curl_init();

   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
	
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}
/* End call API */

/* Ceta criteria/filter */
function ceta_filter_function()
{
	// If reset all load
	$_SESSION['order_head'] = '';
	$_SESSION['search_active'] = '';	
	
	// Get user details if logged in
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->ID;
		$user_info = get_userdata($user->ID);
	}
	
	// Get sponsors CEF list
	$get_data = callAPI('GET', 'https://cefdata.com/api/sponsorscef/', false);
	$sponsors = json_decode($get_data, true);
	$sponsors_options = '';
	foreach($sponsors As &$spon)
	{
		$sponsors_options .= '<option value="' . str_replace(' ', '%20', $spon['sponsor_name']) . '" >' . $spon['sponsor_name'] . '</option>';
	}
	
	// Get sponsors BDC list
	$get_data = callAPI('GET', 'https://cefdata.com/api/sponsorsbdc/', false);
	$sponsors_bdc = json_decode($get_data, true);
	$sponsors_bdc_options = '';
	foreach($sponsors_bdc As &$bdc)
	{
		$sponsors_bdc_options .= '<option value="' . str_replace(' ', '%20', $bdc['sponsor_name']) . '" >' . $bdc['sponsor_name'] . '</option>';
	}	
	
	// Get sponsors for non funds list
	$get_data = callAPI('GET', 'https://cefdata.com/api/sponsorsnl/', false);
	$sponsors_nl = json_decode($get_data, true);
	$sponsors_nl_options = '';
	foreach($sponsors_nl As &$spon_nl)
	{
		$sponsors_nl_options .= '<option value="' . str_replace(' ', '%20', $spon_nl['sponsor_name']) . '" >' . $spon_nl['sponsor_name'] . '</option>';
	}
	
	// Get type for non funds list
	$type_options = '';
	$type_options .= '<option value="T" >Tender Offer Fund</option>';
	$type_options .= '<option value="I" >Interval Fund</option>';
	
	// Get peer group list
	$get_data = callAPI('GET', 'https://cefdata.com/api/peergroups/', false);
	$peergroups = json_decode($get_data, true);
	$peergroups_options = '';
	foreach($peergroups As &$peer)
	{
		$peergroups_options .= '<option value="' . str_replace(' ', '%20', $peer) . '" >' . $peer . '</option>';
	}
	
	// Get main group list
	$get_data = callAPI('GET', 'https://cefdata.com/api/maingroups/', false);
	$maingroups = json_decode($get_data, true);
	$maingroups_options = '';
	foreach($maingroups As &$main)
	{
		$maingroups_options .= '<option value="' . str_replace(' ', '%20', $main) . '" >' . $main . '</option>';
	}

	// Get major group for non funds list
	$majorgroups_options = '';
	$majorgroups_options .= '<option value="Bond" >Bond</option>';
	$majorgroups_options .= '<option value="Equity" >Equity</option>';
	
	// Get Sub group non funds list
	$get_data = callAPI('GET', 'https://cefdata.com/api/nlgroups/', false);
	$subgroups = json_decode($get_data, true);
	$subgroups_options = '';
	foreach($subgroups As $sub)
	{
		$subgroups_options .= '<option value="' . str_replace(' ', '%20', $sub['group']) . '" >' . $sub['group'] . '</option>';
	}	
	
	// Get user role
	$user_meta = get_userdata($user_id);
	$user_roles = $user_meta->roles;
	
	// Start of html
	$html = "";
	
	$html .= '<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
					<a class="nav-link active" id="listed_funds-tab" data-toggle="tab" data-listed="listedfunds" href="#listed_funds, #listed_funds_list" role="tab" aria-controls="listed_funds, listed_funds_list" aria-selected="true">Listed Funds</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" id="non_listed_funds-tab" data-toggle="tab" data-listed="nonlistedfunds" href="#non_listed_funds, #non_listed_funds_list" role="tab" aria-controls="non_listed_funds, non_listed_funds_list" aria-selected="false">Non Listed Funds</a>
				  </li>
				</ul>';	
	$html .= '<input type="hidden" name="hid_funds_list" id="hid_funds_list" value="listedfunds" />';
				
	$html .= '<div class="tab-content" id="myTabContent">';			
	$html .= '<div class="tab-pane show active" id="listed_funds" role="tabpanel" aria-labelledby="listed_funds-tab">';
		include(plugin_dir_path(__FILE__).'inc_template/listed_funds_search.php');
	$html .= '</div>';
	$html .= '<div class="tab-pane" id="non_listed_funds" role="tabpanel" aria-labelledby="non_listed_funds-tab">';
	include(plugin_dir_path(__FILE__).'inc_template/non_listed_funds_search.php');
	$html .= '</div>';
	$html .= '</div>';
	
	$html .= '<div id="cover-spin"></div>';
	
	return $html;
}
add_shortcode('ceta_filter_options', 'ceta_filter_function');
/* End Ceta criteria/filter */

/* Get ceta funds */
function ceta_funds() {
	// Get user's column selected
	$colsStr = '';
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->ID;
		$user_info = get_userdata($user->ID);
		
		// Get criteria columns
		global $wpdb;
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM aa_criteria_columns WHERE user_id = %s', $user_id));
		$colsStr = $results[0]->crit_colums;
		$colsArray = explode(',', $colsStr);
		if( empty($colsArray) ) {
			$colsArray = explode(',', 'full_name,sponsor,peer_group,leverage,non_lev_exp_ratio,mk_yield,div_freq,discount,zstat_3mo,zstat_6mo,net_assets_m,duration,tr_price_1yr_rank,price,nav,beta_12,corr_12,tr_nav_inception,tr_price_inception,inception_date,');
		}
	}
	else {
		$colsStr = 'full_name,sponsor,peer_group,leverage,non_lev_exp_ratio,mk_yield,div_freq,discount,zstat_3mo,zstat_6mo,net_assets_m,duration,tr_price_1yr_rank,price,nav,beta_12,corr_12,tr_nav_inception,tr_price_inception,inception_date,';
		$colsArray = explode(',', $colsStr);		
	}
	
	// Get first aggregrates data
	$get_data2 = callAPI('GET', 'https://cefdata.com/api/funds/?aggregate=true', false);
	$response2 = json_decode($get_data2, true);
	$aggr_data = $response2;
	$data_agg['aggregrate'] = $aggr_data;	
	
	// Get user watchlist
	global $wpdb;
	$vWatchlist = null;
	$allWatchlist = [];
	$allWatchlistStr = '';
	if(!empty($user_id)) {
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM aa_user_watchlist WHERE user_id=%s AND fund_type="fundlist"', $user_id));
		foreach($results As $res) {
			$vWatchlist[$res->port_id] = explode(',', $res->watchlist);
			$vPort[] = $res->port_id;
			$allWatchlistStr .= $res->watchlist;
		}
	}		
	$allWatchlist = explode(',', substr($allWatchlistStr, 0, -1));	
	
	// Get first funds data
	$rec_count = 100;
	$limit_no = 25;
	$get_data = callAPI('GET', 'https://cefdata.com/api/funds/?limit=25', false);
	$response = json_decode($get_data, true);	
	$errors = $response;
	$data = $response;
	$recArr = end($data);
	$rec_count = $recArr['count'];
	$page_split = $rec_count / $limit_no;	
	$page_split = ceil($page_split);	
	$html = '<div class="p_status" ></div>';	
	
	$html .= '<div class="row mt-5 mb-4"><div class="col-md-22 pt-2" >View columns - </div>';
	$html .= '<input type="hidden" name="hid_col_selected" id="hid_col_selected" value="' . $colsStr . '" />';
	$html .= '<select class="sel_column_picker d-none" multiple  ></select></div>';	
	
	$html .= '<div ><select name="sel_view_records" class="" ng-options="listrec.label for listrec in viewreclist" ng-model="sel_view_records" ng-change="change_view_rec()" ></select>&nbsp;&nbsp;View records </div>';	
	include(plugin_dir_path(__FILE__).'inc_template/pagination_funds.php');		
	$html .= '<div class="div_funds_list ng-scope" >';	
	
	// First funds list
	include(plugin_dir_path(__FILE__).'inc_template/funds_list.php');
	
	include(plugin_dir_path(__FILE__).'inc_template/pagination_funds.php');	
	return $html;
}
add_shortcode('aica-funds', 'ceta_funds');
/* End get ceta funds */

/* Portfolio option */
function func_portfolio_option() {
	global $wpdb;
	
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->ID;
	}	
	
	// Number of portfolio allowed
	$adminPortNo = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'aica_admin WHERE aica_id = 1'));
	$portfolioNum = $adminPortNo[0]->aica_value;
	
	$portOptRes = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "user_portfolio WHERE `user_id` = %s AND `fund_type` = %s ORDER BY port_id ASC", $user_id, 'fundlist'));
	$html = '';
	$html .= '<div ng-controller="viewwatchlist" class="border viewwatchlist" >';
	$html .= '<div class="containter m-4" >';
	$html .= '<div class="row" ><div class="col-md-6 p-3 border text-info" >';
	$html .= 'Your Portfolios (<span class="span_portfolio" >' . $portOptRes[0]->port_desc . '</span>)<br /><a href="" class="a_edit_port_name" >[<i class="fas fa-font"></i>&nbsp;RENAME]</a> &nbsp;&nbsp; <a href="" class="a_delete_port_name" data-toggle="modal" data-target="#exampleModalLive" >[<i class="fas fa-minus-square"></i>&nbsp;DELETE]</a>';
	$html .= '<div class="clearfix pt-3 pb-3" ></div>';
	$html .= '<select id="sel_port_option" name="sel_port_option" >';
	$optCount = 0;
	foreach($portOptRes As $portOpt) {
		$html .= '<option value="' . $portOpt->port_id . '" >' . $portOpt->port_desc . '</option>';
		$optCount++;
	}
	$html .= '</select>';	
	$html .= '</div>';
	$html .= '<div class="col-md-6 p-3 border bg-light" >';
	$html .= '<div class="col-md-6" ><input type="text" name="txt_new_port" class="form-control" placeholder="create portfolio" ng-model="txt_new_port" ' . ($optCount >= $portfolioNum ? 'disabled' : '') . '/></div>';
	$html .= '<div class="col-md-6" ><button class="create_port btn btn-primary" ng-click="click_new_port()" ' . ($optCount >= $portfolioNum ? 'disabled' : '') . '><i class="fas fa-plus-square"></i>&nbsp;&nbsp;NEW PORTFOLIO</button></div>';
	$html .= '<div class="container port_status pt-3 text-info" >' . ($optCount >= $portfolioNum ? 'You have reached ' . $portfolioNum . ' portfolios allowed' : '') . '</div>';		
	$html .= '</div>';
	$html .= '</div>';
	
	$html .= '<div class="row mb-3" >';
	$html .= '<div class="div_port_rename col-md-3 p-2 border" style="display:none;" ><input type="text" class="form-control" id="txt_port_rename" name="txt_port_rename" value="' . $portOptRes[0]->port_desc . '" placeholder="' . $portOptRes[0]->port_desc . '" />';
	$html .= '<button class="butt_port_rename btn btn-secondary" ng-click="rename_port()" >RENAME</button>';
	$html .= '</div>';
	$html .= '<div class="div_port_delete col-md-3 p-2 border" style="display:none;" >';
	$html .= '<button class="butt_port_delete btn btn-warning" ng-click="delete_port()" ><i class="fas fa-exclamation-circle"></i>&nbsp;CLICK HERE TO CONFIRM THAT YOU WANT TO DELETE THIS PORTFOLIO (<strong><span class="span_portfolio" >' . $portOptRes[0]->port_desc . '</span></strong>)?</button>';
	$html .= '</div>';	
	$html .= '<input type="hidden" name="hid_port_id" ng-model="hid_port_id" ng-init="hid_port_id=' . $portOptRes[0]->port_id . '" ng-value="' . $portOptRes[0]->port_id . '" />';	
	$html .= '</div>';	
	$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode('porfolio_option', 'func_portfolio_option');
/* End portfolio option */

/* Get ceta funds for portfolio */
function port_ceta_funds() {
	// Get user's column selected
	$colsStr = '';
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->ID;
		$user_info = get_userdata($user->ID);
		
		// Get criteria columns
		global $wpdb;
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM aa_criteria_columns WHERE user_id = %s', $user_id));
		$colsStr = $results[0]->crit_colums;
		$colsArray = explode(',', $colsStr);
		if( empty($colsArray) ) {
			$colsArray = explode(',', 'full_name,sponsor,peer_group,leverage,non_lev_exp_ratio,mk_yield,div_freq,discount,zstat_3mo,zstat_6mo,net_assets_m,duration,tr_price_1yr_rank,price,nav,beta_12,corr_12,tr_nav_inception,tr_price_inception,inception_date,');
		}
	}
	else {
		$colsStr = 'full_name,sponsor,peer_group,leverage,non_lev_exp_ratio,mk_yield,div_freq,discount,zstat_3mo,zstat_6mo,net_assets_m,duration,tr_price_1yr_rank,price,nav,beta_12,corr_12,tr_nav_inception,tr_price_inception,inception_date,';
		$colsArray = explode(',', $colsStr);		
	}
	
	// Get first aggregrates data
	$get_data2 = callAPI('GET', 'https://cefdata.com/api/funds/?aggregate=true', false);
	$response2 = json_decode($get_data2, true);
	$aggr_data = $response2;
	$data_agg['aggregrate'] = $aggr_data;	
	
	// Get user watchlist
	global $wpdb;
	$vWatchlist = [];
	if(!empty($user_id)) {
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM aa_user_watchlist WHERE user_id=%s AND fund_type="fundlist" ORDER BY port_id ASC', $user_id));
		foreach($results As $res) {
			$vWatchlist[$res->port_id] = explode(',', $res->watchlist);
			$vPort[] = $res->port_id;
		}
	}	
	
	// Get first funds data
	$rec_count = 100;
	$limit_no = 25;
	$get_data = callAPI('GET', 'https://cefdata.com/api/funds/?id=' . substr($results[0]->watchlist, 0, -1), false);
	$response = json_decode($get_data, true);
	$errors = $response;
	$data = $response;
	$recArr = end($data);
	$rec_count = $recArr['count'];
	$page_split = $rec_count / $limit_no;	
	$page_split = ceil($page_split);	
	$html = '<div class="p_status" ></div>';	
	
	//$html .= '<div class="row mt-5 mb-4"><div class="col-md-22 pt-2" >View columns - </div>';
	$html .= '<input type="hidden" name="hid_user_id" id="hid_user_id" value="' . $user_id . '" />';
	$html .= '<input type="hidden" name="hid_col_selected" id="hid_col_selected" value="' . $colsStr . '" />';
	$html .= '<input type="hidden" name="hid_page_type" id="hid_page_type" value="view_watchlist" />';
	// Set this is view watchlist page
	$viewWatchList = true;
	//$html .= '<select class="sel_column_picker d-none" multiple  ></select></div>';	
	
	//$html .= '<div ><select name="sel_view_records" class="" ng-options="listrec.label for listrec in viewreclist" ng-model="sel_view_records" ng-change="change_view_rec()" ></select>&nbsp;&nbsp;View records </div>';	
	//include(plugin_dir_path(__FILE__).'inc_template/pagination_funds.php');
	$portOptRes = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "user_portfolio WHERE `user_id` = %s ORDER BY port_id ASC", $user_id));
	
	// Set the tabs
	$html .= '<ul class="nav nav-tabs" id="myTab" >
				  <li class="nav-item active">
					<a class="nav-link " id="fund-tab" data-toggle="tab" href="#fund" >FUND LIST</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" id="holding-tab" data-toggle="tab" href="#holding" >HOLDINGS</a>
				  </li>
				</ul>';
				
	$html .= '<div class="tab-content" id="myTabContent">';
	$html .= '<div class="tab-pane fade in active" id="fund" aria-labelledby="fund-tab">';
	$html .= '<div class="div_funds_list ng-scope" >';	
		include(plugin_dir_path(__FILE__).'inc_template/funds_list.php');				  
	$html .= '</div>';
	$html .= '<div class="tab-pane fade" id="holding" aria-labelledby="holding-tab">';
	$html .= '<div class="div_funds_list div_holding_list ng-scope" >';	
		include(plugin_dir_path(__FILE__).'inc_template/funds_holding_list.php');
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	
	//include(plugin_dir_path(__FILE__).'inc_template/pagination_funds.php');	
	return $html;
}
add_shortcode('port-aica-funds', 'port_ceta_funds');
/* End get ceta funds */

/* Non listed profile */
function func_non_listed__title_profile() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $_GET["id"], false);
	$get_fund_info = json_decode($get_fund_info, true);
	$html = '';
	$html = '<input type="hidden" id="hid_profile_id" value="' . $_GET["id"] . '" />';
	$html .= '<div><span style="font-size:30px;" >' . $get_fund_info[0]['name'] . '</span> - ' . '<span>' . $get_fund_info[0]['category'] . ' / ' . $get_fund_info[0]['group'] . '</span></div>';
	$html .= '<div><span style="font-weight:bold;color:red;" ><i>Data as of ' . date('M. d, Y', strtotime($get_fund_info[0]['as_of'])) . '</i></span></div>';	
	return $html;
}
add_shortcode('non_listed__title_profile', 'func_non_listed__title_profile');

function func_non_listed_profile() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $_GET["id"], false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/profile_fund_info.php');		
	return $html;
}
add_shortcode('non_listed_profile', 'func_non_listed_profile');

function func_capital_structure() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $_GET["id"], false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/capital_struc_info.php');		
	return $html;
}
add_shortcode('capital_structure', 'func_capital_structure');

function func_fund_data() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $_GET["id"], false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/fund_data_info.php');		
	return $html;
}
add_shortcode('fund_data', 'func_fund_data');

function func_latest_repurchase() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $_GET["id"], false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/latest_repurch_info.php');		
	return $html;
}
add_shortcode('latest_repurchase', 'func_latest_repurchase');

function func_tender_results() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $_GET["id"], false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/tender_results_info.php');		
	return $html;
}
add_shortcode('tender_results', 'func_tender_results');

function func_portfolio_data() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $_GET["id"], false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/portfolio_data_info.php');		
	return $html;
}
add_shortcode('portfolio_data', 'func_portfolio_data');

function func_top_ten_holdings() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nltop10/' . $_GET["id"] . '/', false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/top_ten_holdings_info.php');		
	return $html;
}
add_shortcode('top_ten_holdings', 'func_top_ten_holdings');

function func_growth_10000() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlgrowth/' . $_GET["id"] . '/', false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/growth_10000_info.php');		
	return $html;
}
add_shortcode('growth_10000', 'func_growth_10000');

function func_class_info() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlclasses/' . $_GET["id"] . '/', false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/class_info_info.php');		
	return $html;
}
add_shortcode('class_info', 'func_class_info');

function func_daily_nav() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlclasses/' . $_GET["id"] . '/', false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/daily_nav_info.php');		
	return $html;
}
add_shortcode('daily_nav', 'func_daily_nav');

function func_prospectus_data() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlclasses/' . $_GET["id"] . '/', false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/prospectus_data_info.php');		
	return $html;
}
add_shortcode('prospectus_data', 'func_prospectus_data');

function func_distribution_data() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlclasses/' . $_GET["id"] . '/', false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/distribution_data_info.php');		
	return $html;
}
add_shortcode('distribution_data', 'func_distribution_data');

function func_3_year_dist() {
	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nldiv/' . $_GET["id"] . '/', false);
	$get_fund_info = json_decode($get_fund_info, true);
	include(plugin_dir_path(__FILE__).'inc_template/3_year_dist_info.php');		
	return $html;
}
add_shortcode('3_year_dist', 'func_3_year_dist');

function func_watchlist_button() {
	global $wpdb;
	$buttStr = 'ADD TO WATCHLIST';
	$fundStatus = 'add';
	$buttonColor = 'butt-watchlist-remove';
	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->ID;
		$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM `aa_user_watchlist` WHERE user_id=%d AND fund_type=%s AND (watchlist LIKE %s OR watchlist LIKE %s) LIMIT 1", $user_id, 'nlfundlist' ,'%,' . $_GET['id'] . ',%', '%' . $_GET['id'] . ',%'));
		if( !empty($results) ) {
			$buttStr = 'REMOVE WATCHLIST';
			$fundStatus = 'remove';
			$buttonColor = 'butt-watchlist-add';
		}
	}
	$html = '<button class="d-none butt-watchlist ' . $buttonColor . ' fusion-button button-flat fusion-button-default-shape fusion-button-default-size button-default button-11 fusion-button-default-span fusion-button-default-type" data-status="' . $fundStatus . '" data-id="' . $_GET['id'] . '" data-type="nlfundlist" data-userid="' . $user_id . '" >' . $buttStr . '</button>';
	$html .= '<input type="hidden" id="hid_fundtype" value="nlfundlist" />';
	$html .= '<input type="hidden" id="hid_user_id" value="' . $user_id . '" />';
	$html .= '<input type="hidden" id="hid_fund_id" value="' . $_GET['id'] . '" />';	
	return $html;
}
add_shortcode('watchlist_button', 'func_watchlist_button');

function func_watchlist_list() {
	global $wpdb;

	if(is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->ID;
		// Non fund watchlist
		$nlresults = $wpdb->get_results($wpdb->prepare("SELECT * FROM `aa_user_watchlist` WHERE user_id=%d AND fund_type=%s", $user_id, 'nlfundlist'));
		$nlfundids = explode(',', $nlresults[0]->watchlist);
		if( !empty($nlresults) )
			include(plugin_dir_path(__FILE__).'inc_template/account_nl_watchlist.php');				
		// Fund watchlist
		$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM `aa_user_watchlist` WHERE user_id=%d AND fund_type=%s", $user_id, 'fundlist'));
		$fundids = explode(',', $results[0]->watchlist);
		if( !empty($results) )
			include(plugin_dir_path(__FILE__).'inc_template/account_watchlist.php');				
	}
	return $html;
}
add_shortcode('watchlist_list', 'func_watchlist_list');
/* END Non listed profile */
