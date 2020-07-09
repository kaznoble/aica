<?php
	// Set initial columns
	$fundColumns = ['Name'=>'full_name','Sponsor'=>'sponsor','Peer Group'=>'peer_group','Leverage %'=>'leverage','Non Lev Expense Ratio'=>'non_lev_exp_ratio','Mkt Price Yield'=>'mk_yield','Div Frequency'=>'div_freq','Disc/Prm'=>'discount','3-month Z-Stat'=>'zstat_3mo','6-month Z-Stat'=>'zstat_6mo','Net Assets'=>'net_assets_m','Effective Duration'=>'duration','PG Mkt Pr Rank'=>'tr_price_1yr_rank','Market Price'=>'price','NAV'=>'nav','*Beta'=>'beta_12','*Corr'=>'corr_12','Inception NAV TR'=>'tr_nav_inception','Inception Mkt Pr'=>'tr_price_inception','Inception Date'=>'inception_date'];

	// Get first row data with column name
	if( !empty($data) ) {
		$first_data = array_keys($data[0]);
		array_shift($first_data);
		foreach($first_data As $key)
		{
			$html .= '<input type="hidden" id="filter_min_' . $key . '" ng-model="filter_min_' . $key . '" value="' . (!empty($data_agg['aggregrate']['filter_min_' . $key]) ? $data_agg['aggregrate']['filter_min_' . $key] : '') . '" />';
			$html .= '<input type="hidden" id="filter_max_' . $key . '" ng-model="filter_max_' . $key . '" value="' . (!empty($data_agg['aggregrate']['filter_max_' . $key]) ? $data_agg['aggregrate']['filter_max_' . $key] : '') . '" />';		
		}
	}
	if( !empty($rec_count) && !$viewWatchList ) {
		$html .= '<div class="mt-3" >Records found (' . $rec_count . ') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; * <span class="font-italic" style="font-size:0.8em;" >Beta and Correlation data is based on <a href="https://cefdata.com/index/details/412/" target="_blank">CEF Advisors’ 12 Major Sector Index</a> market price data</span></div>';
	}
	$html .= '<input type="hidden" name="hid_total_rec" id="hid_total_rec" ng-model="total_rec" value="' . $rec_count . '" />';
	$html .= '<div class="table-responsive">';
	$html .= '<table class="table table-sm table-striped table-hover" ><thead><tr>';
						if( is_user_logged_in() ) {
							$html .= '<th ' . ($viewWatchList ? 'class="d-none"' : '') . '><i class="fas fa-eye"></i> Portfolios</th>';
						}
						$html .= '<th class="headcol tab-col-ticker ' . (($_SESSION['order_head'] == 'ticker' || $_SESSION['order_head'] == '-ticker') ? 'order-column-th' : '') . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "ticker" ? '-ticker' : 'ticker') : '-ticker') . '" >Ticker</a></th>';
						foreach($fundColumns As $key => $fundCol) {
							$html .= '<th class="tab-col-' . $fundCol . ' ' .(($_SESSION['order_head'] == $fundCol || $_SESSION['order_head'] == '-' . $fundCol) ? 'order-column-th' : '') . ' ' . ( in_array($fundCol, $colsArray) ? '' : (is_user_logged_in() ? 'd-none' : '') ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == $fundCol ? '-' . $fundCol : $fundCol) : '-' . $fundCol) . '" >' . ucwords(str_replace('_',' ',$key)) . '</a></th>';
						}
	$html .= '</thead></tr>';

	// Get user's portfolio
	if( is_user_logged_in() ) {
		$resPort = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'user_portfolio WHERE user_id = ' . $user_id . ' AND fund_type="fundlist"'));
		$resPort = json_decode(json_encode($resPort), true);
	}
	//var_dump($resPort);
	foreach($data As $key => $dat)
	{
		$html .= '<tr >';
		if( is_user_logged_in() ) {
			$html .= '<td class="' . ($viewWatchList ? 'd-none' : '') . ' ' . (!empty($dat['id'])  && !empty($allWatchlist) ? (in_array($dat['id'], $allWatchlist) ? 'watchlist_row' : '') : '')  . '" >';
			$html .= '<a class="a_portfolio " data-aport="' . $dat['id'] . '" >[Portfolio]</a>';
			$html .= '<div class="div_portfolio_' . $dat['id'] . ' div_class_port" style="display:none;" >';
							if(empty($resPort)) {
								$html .= '<div class="" ><input class="watchlist" ' . ($viewWatchList ? 'disabled' : '') . ' type="checkbox" name="watchlist" data-port="" ng-model="chbx_' . (!empty($dat['id']) ? $dat['id'] : 'none') . '" ng-checked="' . (!empty($dat['id']) && !empty($vWatchlist) ? (in_array($dat['id'], $vWatchlist) ? 'true' : 'false') : '') . '" value="' . (!empty($dat['id']) ? $dat['id'] : 'none') . '" ng-click="clickWatchlist()" ' . (!empty($dat['id']) && !empty($vWatchlist) ? (in_array($dat['id'], $vWatchlist) ? 'checked' : '') : '') . ' /> ';
								$html .= 'New Portfolio';
								$html .= '</div>';
							} else {
								foreach($resPort As $port) {
									$html .= '<div class="' . ($viewWatchList ? (!empty($vWatchlist[$port['port_id']]) ? '' : 'd-none') : '') . '" ><input class="watchlist" ' . ($viewWatchList ? 'disabled' : '') . ' type="checkbox" name="watchlist" data-port="' . $port['port_id'] . '" ng-model="chbx_' . $port['port_id'] . '_' . (!empty($dat['id']) ? $dat['id'] : 'none') . '" ng-checked="' . (!empty($dat['id']) && !empty($vWatchlist[$port['port_id']]) ? (in_array($dat['id'], $vWatchlist[$port['port_id']]) ? 'true' : 'false') : '') . '" value="' . (!empty($dat['id']) ? $dat['id'] : 'none') . '" ng-click="clickWatchlist()" ' . (!empty($dat['id']) && !empty($vWatchlist[$port['port_id']]) ? (in_array($dat['id'], $vWatchlist[$port['port_id']]) ? 'checked' : '') : '') . ' /> ';
									$html .= $port['port_desc'];
									$html .= '</div>';
								}
							}
			$html .= '</div>';
			$html .= '</td>';
		}
		$html .= '<td class="headcol tab-col-ticker ' . (($_SESSION['order_head'] == 'ticker' || $_SESSION['order_head'] == '-ticker') ? 'order-column-td' : '') . '">' . (!empty($dat['ticker']) ? '<a href="https://cefdata.com/funds/' . strtolower($dat['ticker']) . '" target="_blank">' . $dat['ticker'] : '') . '</a></td>';
		foreach($fundColumns As $fundCol) {
			$html .= '<td class="tab-col-' . $fundCol . ' ' . (($_SESSION['order_head'] == $fundCol || $_SESSION['order_head'] == '-' . $fundCol) ? 'order-column-td' : '') . ' ' . ( in_array($fundCol, $colsArray) ? '' : (is_user_logged_in() ? 'd-none' : '') ) . '">' . (!empty($dat[$fundCol]) ? ($fundCol == 'full_name' ? '<a href="https://cefdata.com/funds/' . strtolower($dat['ticker']) . '" target="_blank">' . ucwords(str_replace('_',' ',$dat[$fundCol])) . '</a>' : ($fundCol == 'inception_date' ? date('m/d/Y', strtotime($dat[$fundCol])) : $dat[$fundCol])  ) : '') . '</td>';
		}
		$html .= '</tr>';
	}
		
	$html .= '</table>';
	$html .= '</div>';
	$html .= '</div>';
?>