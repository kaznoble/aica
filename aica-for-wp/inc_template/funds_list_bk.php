<?php
	$html .= '<input type="hidden" id="filter_max_liq_90" ng-model="filter_max_liq_90" value="' . $data_agg['aggregrate']['filter_max_liq_90'] . '" />';
	$html .= '<input type="hidden" id="filter_min_liq_90" ng-model="filter_min_liq_90" value="' . $data_agg['aggregrate']['filter_min_liq_90'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_nav_1yr" ng-model="filter_max_tr_nav_1yr" value="' . $data_agg['aggregrate']['filter_max_tr_nav_1yr'] . '" />';
	$html .= '<input type="hidden" id="filter_min_non_lev_exp_ratio" value="' . $data_agg['aggregrate']['filter_min_non_lev_exp_ratio'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_nav_ytd" value="' . $data_agg['aggregrate']['filter_min_tr_nav_ytd'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_price_1yr" value="' . $data_agg['aggregrate']['filter_max_tr_price_1yr'] . '" />';
	$html .= '<input type="hidden" id="filter_min_net_assets_m" value="' . $data_agg['aggregrate']['filter_min_net_assets_m'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_price_ytd" value="' . $data_agg['aggregrate']['filter_min_tr_price_ytd'] . '" />';
	$html .= '<input type="hidden" id="filter_max_net_assets_m" value="' . $data_agg['aggregrate']['filter_max_net_assets_m'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_nav_5yr" value="' . $data_agg['aggregrate']['filter_min_tr_nav_5yr'] . '" />';
	$html .= '<input type="hidden" id="filter_min_leverage" value="' . $data_agg['aggregrate']['filter_min_leverage'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_price_5yr" value="' . $data_agg['aggregrate']['filter_min_tr_price_5yr'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_price_ytd" value="' . $data_agg['aggregrate']['filter_max_tr_price_ytd'] . '" />';
	$html .= '<input type="hidden" id="filter_min_mk_yield" value="' . $data_agg['aggregrate']['filter_min_mk_yield'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_nav_ytd" value="' . $data_agg['aggregrate']['filter_max_tr_nav_ytd'] . '" />';
	$html .= '<input type="hidden" id="filter_max_mk_yield" value="' . $data_agg['aggregrate']['filter_max_mk_yield'] . '" />';
	$html .= '<input type="hidden" id="filter_max_leverage" value="' . $data_agg['aggregrate']['filter_max_leverage'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_nav_3yr" value="' . $data_agg['aggregrate']['filter_min_tr_nav_3yr'] . '" />';
	$html .= '<input type="hidden" id="filter_max_discount" ng-model="filter_max_discount" value="' . $data_agg['aggregrate']['filter_max_discount'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_price_3yr" value="' . $data_agg['aggregrate']['filter_min_tr_price_3yr'] . '" />';
	$html .= '<input type="hidden" id="filter_min_discount" mg-model="filter_min_discount" value="' . $data_agg['aggregrate']['filter_min_discount'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_price_5yr" value="' . $data_agg['aggregrate']['filter_max_tr_price_5yr'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_nav_5yr" value="' . $data_agg['aggregrate']['filter_max_tr_nav_5yr'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_price_3yr" value="' . $data_agg['aggregrate']['filter_max_tr_price_3yr'] . '" />';
	$html .= '<input type="hidden" id="filter_max_tr_nav_3yr" value="' . $data_agg['aggregrate']['filter_max_tr_nav_3yr'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_nav_1yr" value="' . $data_agg['aggregrate']['filter_min_tr_nav_1yr'] . '" />';
	$html .= '<input type="hidden" id="filter_max_non_lev_exp_ratio" value="' . $data_agg['aggregrate']['filter_max_non_lev_exp_ratio'] . '" />';
	$html .= '<input type="hidden" id="filter_min_tr_price_1yr" value="' . $data_agg['aggregrate']['filter_min_tr_price_1yr'] . '" />';
	$html .= '<input type="hidden" id="filter_min_beta_12" value="' . $data_agg['aggregrate']['filter_min_beta_12'] . '" />';
	$html .= '<input type="hidden" id="filter_max_beta_12" value="' . $data_agg['aggregrate']['filter_max_beta_12'] . '" />';
	$html .= '<input type="hidden" id="filter_min_price" value="' . $data_agg['aggregrate']['filter_min_price'] . '" />';
	$html .= '<input type="hidden" id="filter_max_price" value="' . $data_agg['aggregrate']['filter_max_price'] . '" />';
	$html .= '<input type="hidden" id="filter_min_nav" value="' . $data_agg['aggregrate']['filter_min_nav'] . '" />';
	$html .= '<input type="hidden" id="filter_max_nav" value="' . $data_agg['aggregrate']['filter_max_nav'] . '" />';
	$html .= '<input type="hidden" id="filter_min_corr_12" value="' . $data_agg['aggregrate']['filter_min_corr_12'] . '" />';
	$html .= '<input type="hidden" id="filter_max_corr_12" value="' . $data_agg['aggregrate']['filter_max_corr_12'] . '" />';		
	
	$html .= '<div class="mt-3" >Records found (' . $rec_count . ') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; * <span class="font-italic" style="font-size:0.8em;" >Beta and Correlation data is based on <a href="https://cefdata.com/index/details/412/" target="_blank">CEF Advisors’ 12 Major Sector Index</a> market price data</span></div>';
	$html .= '<input type="hidden" name="hid_total_rec" id="hid_total_rec" ng-model="total_rec" value="' . $rec_count . '" />';
	$html .= '<div class="table-responsive">';
	$html .= '<table class="table table-sm table-striped table-hover" ><thead><tr>
						<th class="headcol tab-col-ticker ' . (($_SESSION['order_head'] == 'ticker' || $_SESSION['order_head'] == '-ticker') ? 'order-column-th' : '') . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "ticker" ? '-ticker' : 'ticker') : '-ticker') . '" >Ticker</a></th>
						<th class="tab-col-full_name ' . (($_SESSION['order_head'] == 'full_name' || $_SESSION['order_head'] == '-full_name') ? 'order-column-th' : '') . ' ' . ( in_array('full_name', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "name" ? '-full_name' : 'full_name') : '-full_name') . '" >Name</a></th>
						<th class="tab-col-sponsor ' . (($_SESSION['order_head'] == 'sponsor' || $_SESSION['order_head'] == '-sponsor') ? 'order-column-th' : '') . ' ' . ( in_array('sponsor', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "sponsor" ? '-sponsor' : 'sponsor') : '-sponsor') . '" >Sponsor</a></th>						
						<th class="tab-col-peer_group ' . (($_SESSION['order_head'] == 'peer_group' || $_SESSION['order_head'] == '-peer_group') ? 'order-column-th' : '') . ' ' . ( in_array('peer_group', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "peer_group" ? '-peer_group' : 'peer_group') : '-peer_group') . '" >Peer Group</a></th>						
						<th class="tab-col-leverage ' . (($_SESSION['order_head'] == 'leverage' || $_SESSION['order_head'] == '-leverage') ? 'order-column-th' : '') . ' ' . ( in_array('leverage', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "leverage" ? '-leverage' : 'leverage') : '-leverage') . '" >Leverage %</a></th>
						<th class="tab-col-non_lev_exp_ratio ' . (($_SESSION['order_head'] == 'non_lev_exp_ratio' || $_SESSION['order_head'] == '-non_lev_exp_ratio') ? 'order-column-th' : '') . ' ' . ( in_array('non_lev_exp_ratio', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "non_lev_exp_ratio" ? '-non_lev_exp_ratio' : 'non_lev_exp_ratio') : '-non_lev_exp_ratio') . '" >Non Lev Expense Ratio</a></th>
						<th class="tab-col-mk_yield ' . (($_SESSION['order_head'] == 'mk_yield' || $_SESSION['order_head'] == '-mk_yield') ? 'order-column-th' : '') . ' ' . ( in_array('mk_yield', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "mk_yield" ? '-mk_yield' : 'mk_yield') : '-mk_yield') . '" >Mkt Price Yield</a></th>
						<th class="tab-col-div_freq ' . (($_SESSION['order_head'] == 'div_freq' || $_SESSION['order_head'] == '-div_freq') ? 'order-column-th' : '') . ' ' . ( in_array('div_freq', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "div_freq" ? '-div_freq' : 'div_freq') : '-div_freq') . '" >Div Frequency</a></th>							
						<th class="tab-col-discount ' . (($_SESSION['order_head'] == 'discount' || $_SESSION['order_head'] == '-discount') ? 'order-column-th' : '') . ' ' . ( in_array('discount', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "discount" ? '-discount' : 'discount') : '-discount') . '" >Disc/Prm</a></th>
						<th class="tab-col-zstat_3mo ' . (($_SESSION['order_head'] == 'zstat_3mo' || $_SESSION['order_head'] == '-zstat_3mo') ? 'order-column-th' : '') . ' ' . ( in_array('zstat_3mo', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "zstat_3mo" ? '-zstat_3mo' : 'zstat_3mo') : '-zstat_3mo') . '" >3-month Z-Stat</a></th>
						<th class="tab-col-zstat_6mo ' . (($_SESSION['order_head'] == 'zstat_6mo' || $_SESSION['order_head'] == '-zstat_6mo') ? 'order-column-th' : '') . ' ' . ( in_array('zstat_6mo', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "zstat_6mo" ? '-zstat_6mo' : 'zstat_6mo') : '-zstat_6mo') . '" >6-month Z-Stat</a></th>
						<th class="tab-col-net_assets_m ' . (($_SESSION['order_head'] == 'net_assets_m' || $_SESSION['order_head'] == '-net_assets_m') ? 'order-column-th' : '') . ' ' . ( in_array('net_assets_m', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "net_assets_m" ? '-net_assets_m' : 'net_assets_m') : '-net_assets_m') . '" >Net Assets</a></th>
						<th class="tab-col-duration ' . (($_SESSION['order_head'] == 'duration' || $_SESSION['order_head'] == '-duration') ? 'order-column-th' : '') . ' ' . ( in_array('duration', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "duration" ? '-duration' : 'duration') : '-duration') . '" >Effective Duration</a></th>		
						<th class="tab-col-tr_price_1yr_rank ' . (($_SESSION['order_head'] == 'tr_price_1yr_rank' || $_SESSION['order_head'] == '-tr_price_1yr_rank') ? 'order-column-th' : '') . ' ' . ( in_array('tr_price_1yr_rank', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "tr_price_1yr_rank" ? '-tr_price_1yr_rank' : 'tr_price_1yr_rank') : '-tr_price_1yr_rank') . '" >PG Mkt Pr Rank</a></th>
						<th class="tab-col-price ' . (($_SESSION['order_head'] == 'price' || $_SESSION['order_head'] == '-price') ? 'order-column-th' : '') . ' ' . ( in_array('price', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "price" ? '-price' : 'price') : '-price') . '" >Market Price</a></th>
						<th class="tab-col-nav ' . (($_SESSION['order_head'] == 'nav' || $_SESSION['order_head'] == '-nav') ? 'order-column-th' : '') . ' ' . ( in_array('nav', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "nav" ? '-nav' : 'nav') : '-nav') . '" >NAV</a></th>
						<th class="tab-col-beta_12 ' . (($_SESSION['order_head'] == 'beta_12' || $_SESSION['order_head'] == '-beta_12') ? 'order-column-th' : '') . ' ' . ( in_array('beta_12', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "beta_12" ? '-beta_12' : 'beta_12') : '-beta_12') . '" >*Beta</a></th>
						<th class="tab-col-corr_12 ' . (($_SESSION['order_head'] == 'corr_12' || $_SESSION['order_head'] == '-corr_12') ? 'order-column-th' : '') . ' ' . ( in_array('corr_12', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "corr_12" ? '-corr_12' : 'corr_12') : '-corr_12') . '" >*Corr</a></th>
						<th class="tab-col-tr_nav_inception ' . (($_SESSION['order_head'] == 'tr_nav_inception' || $_SESSION['order_head'] == '-tr_nav_inception') ? 'order-column-th' : '') . ' ' . ( in_array('tr_nav_inception', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "tr_nav_inception" ? '-tr_nav_inception' : 'tr_nav_inception') : '-tr_nav_inception') . '" >Inception NAV TR</a></th>
						<th class="tab-col-tr_price_inception ' . (($_SESSION['order_head'] == 'tr_price_inception' || $_SESSION['order_head'] == '-tr_price_inception') ? 'order-column-th' : '') . ' ' . ( in_array('tr_price_inception', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "tr_price_inception" ? '-tr_price_inception' : 'tr_price_inception') : '-tr_price_inception') . '" >Inception Mkt Pr </a></th>						
						<th class="tab-col-inception_date ' . (($_SESSION['order_head'] == 'inception_date' || $_SESSION['order_head'] == '-inception_date') ? 'order-column-th' : '') . ' ' . ( in_array('inception_date', $colsArray) ? '' : 'd-none' ) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == "inception_date" ? '-inception_date' : 'inception_date') : '-inception_date') . '" >Inception Date</a></th>
						</tr></thead>';
	foreach($data As $key => $dat)
	{
		$html .= '<tr>';
		$html .= '<td class="headcol tab-col-ticker ' . (($_SESSION['order_head'] == 'ticker' || $_SESSION['order_head'] == '-ticker') ? 'order-column-td' : '') . '">' . (!empty($dat['ticker']) ? '<a href="https://cefdata.com/funds/' . strtolower($dat['ticker']) . '" target="_blank">' . $dat['ticker'] : '') . '</a></td>';
		$html .= '<td class="tab-col-full_name ' . (($_SESSION['order_head'] == 'full_name' || $_SESSION['order_head'] == '-full_name') ? 'order-column-td' : '') . ' ' . ( in_array('full_name', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['full_name']) ? '<a href="https://cefdata.com/funds/' . strtolower($dat['ticker']) . '" target="_blank">' . $dat['full_name'] : '') . '</td>';			
		$html .= '<td class="tab-col-sponsor ' . (($_SESSION['order_head'] == 'sponsor' || $_SESSION['order_head'] == '-sponsor') ? 'order-column-td' : '') . ' ' . ( in_array('sponsor', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['sponsor']) ? $dat['sponsor'] : '') . '</td>';		
		$html .= '<td class="tab-col-peer_group ' . (($_SESSION['order_head'] == 'peer_group' || $_SESSION['order_head'] == '-peer_group') ? 'order-column-td' : '') . ' ' . ( in_array('peer_group', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['peer_group']) ? $dat['peer_group'] : '') . '</td>';		
		$html .= '<td class="tab-col-leverage ' . (($_SESSION['order_head'] == 'leverage' || $_SESSION['order_head'] == '-leverage') ? 'order-column-td' : '') . ' ' . ( in_array('leverage', $colsArray) ? '' : 'd-none' ) . '">' . ( isset($dat['leverage']) ? $dat['leverage'] : '') . '</td>';
		$html .= '<td class="tab-col-non_lev_exp_ratio ' . (($_SESSION['order_head'] == 'non_lev_exp_ratio' || $_SESSION['order_head'] == '-non_lev_exp_ratio') ? 'order-column-td' : '') . ' ' . ( in_array('non_lev_exp_ratio', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['non_lev_exp_ratio']) ? $dat['non_lev_exp_ratio'] : '') . '</td>';		
		$html .= '<td class="tab-col-mk_yield ' . (($_SESSION['order_head'] == 'mk_yield' || $_SESSION['order_head'] == '-mk_yield') ? 'order-column-td' : '') . ' ' . ( in_array('mk_yield', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['mk_yield']) ? $dat['mk_yield'] : '') . '</td>';	
		$html .= '<td class="tab-col-div_freq ' . (($_SESSION['order_head'] == 'div_freq' || $_SESSION['order_head'] == '-div_freq') ? 'order-column-td' : '') . ' ' . ( in_array('div_freq', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['div_freq']) ? $dat['div_freq'] : '') . '</td>';		
		$html .= '<td class="tab-col-discount ' . (($_SESSION['order_head'] == 'discount' || $_SESSION['order_head'] == '-discount') ? 'order-column-td' : '') . ' ' . ( in_array('discount', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['discount']) ? ($dat['discount'] > 0 ? '+' : '') . $dat['discount'] : '') . '</td>';	
		$html .= '<td class="tab-col-zstat_3mo ' . (($_SESSION['order_head'] == 'zstat_3mo' || $_SESSION['order_head'] == '-zstat_3mo') ? 'order-column-td' : '') . ' ' . ( in_array('zstat_3mo', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['zstat_3mo']) ? $dat['zstat_3mo'] : '') . '</td>';
		$html .= '<td class="tab-col-zstat_6mo ' . (($_SESSION['order_head'] == 'zstat_6mo' || $_SESSION['order_head'] == '-zstat_6mo') ? 'order-column-td' : '') . ' ' . ( in_array('zstat_6mo', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['zstat_6mo']) ? $dat['zstat_6mo'] : '') . '</td>';	
		$html .= '<td class="tab-col-net_assets_m ' . (($_SESSION['order_head'] == 'net_assets_m' || $_SESSION['order_head'] == '-net_assets_m') ? 'order-column-td' : '') . ' ' . ( in_array('net_assets_m', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['net_assets_m']) ? $dat['net_assets_m'] : '') . '</td>';
		$html .= '<td class="tab-col-duration ' . (($_SESSION['order_head'] == 'duration' || $_SESSION['order_head'] == '-duration') ? 'order-column-td' : '') . ' ' . ( in_array('duration', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['duration']) ? $dat['duration'] : '') . '</td>';
		$html .= '<td class="tab-col-tr_price_1yr_rank ' . (($_SESSION['order_head'] == 'tr_price_1yr_rank' || $_SESSION['order_head'] == '-tr_price_1yr_rank') ? 'order-column-td' : '') . ' ' . ( in_array('tr_price_1yr_rank', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['tr_price_1yr_rank']) ? $dat['tr_price_1yr_rank'] . '/' . $dat['peer_funds'] : '') . '</td>';
		$html .= '<td class="tab-col-price ' . (($_SESSION['order_head'] == 'price' || $_SESSION['order_head'] == '-price') ? 'order-column-td' : '') . ' ' . ( in_array('price', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['price']) ? $dat['price'] : '') . '</td>';
		$html .= '<td class="tab-col-nav ' . (($_SESSION['order_head'] == 'nav' || $_SESSION['order_head'] == '-nav') ? 'order-column-td' : '') . ' ' . ( in_array('nav', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['nav']) ? $dat['nav'] . ' <span class="span_sm_date" >' . date('m/d/y', strtotime($dat['nav_date'])) : '') . '</span></td>';
		$html .= '<td class="tab-col-beta_12 ' . (($_SESSION['order_head'] == 'beta_12' || $_SESSION['order_head'] == '-beta_12') ? 'order-column-td' : '') . ' ' . ( in_array('beta_12', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['beta_12']) ? $dat['beta_12'] : '') . '</td>';
		$html .= '<td class="tab-col-corr_12 ' . (($_SESSION['order_head'] == 'corr_12' || $_SESSION['order_head'] == '-corr_12') ? 'order-column-td' : '') . ' ' . ( in_array('corr_12', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['corr_12']) ? $dat['corr_12'] : '') . '</td>';		
		$html .= '<td class="tab-col-tr_nav_inception ' . (($_SESSION['order_head'] == 'tr_nav_inception' || $_SESSION['order_head'] == '-tr_nav_inception') ? 'order-column-td' : '') . ' ' . ( in_array('tr_nav_inception', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['tr_nav_inception']) ? $dat['tr_nav_inception'] : '') . '</td>';
		$html .= '<td class="tab-col-tr_price_inception ' . (($_SESSION['order_head'] == 'tr_price_inception' || $_SESSION['order_head'] == '-tr_price_inception') ? 'order-column-td' : '') . ' ' . ( in_array('tr_price_inception', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['tr_price_inception']) ? $dat['tr_price_inception'] : '') . '</td>';		
		$html .= '<td class="tab-col-inception_date ' . (($_SESSION['order_head'] == 'inception_date' || $_SESSION['order_head'] == '-inception_date') ? 'order-column-td' : '') . ' ' . ( in_array('inception_date', $colsArray) ? '' : 'd-none' ) . '">' . (!empty($dat['inception_date']) ? date('m/d/Y', strtotime($dat['inception_date'])) : '') . '</td>';				
		$html .= '</tr>';		
	}
	$html .= '</table>';
	$html .= '</div>';
	$html .= '</div>';
?>