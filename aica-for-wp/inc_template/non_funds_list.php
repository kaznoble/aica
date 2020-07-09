<?php
	// Get first row data with column name
	$first_data = array_keys($data[0]);
	array_shift($first_data);
	if( !is_user_logged_in() )
		$first_data = $requireCols;
	foreach($data[0] As $data_key => $data_val)
	{
		if( $data_key != 'name' && $data_key != 'type' && $data_key != 'category' && $data_key != 'group' && $data_key != 'sponsor' && $data_key != 'div_freq' ) {
			if( in_array($data_key, $requireCols) && (!empty($data_agg['aggregrate']['filter_min_' . $data_key]) || $data_agg['aggregrate']['filter_min_' . $data_key] >= 0) && !empty($data_agg['aggregrate']['filter_max_' . $data_key]) ) {
				$html .= '<input type="hidden" id="filter_min_' . $data_key . '" ng-model="filter_min_' . $data_key . '" value="' . (!empty($data_agg['aggregrate']['filter_min_' . $data_key]) ? $data_agg['aggregrate']['filter_min_' . $data_key] : '') . '" />';
				$html .= '<input type="hidden" id="filter_max_' . $data_key . '" ng-model="filter_max_' . $data_key . '" value="' . (!empty($data_agg['aggregrate']['filter_max_' . $data_key]) ? $data_agg['aggregrate']['filter_max_' . $data_key] : '') . '" />';	
			}
		}
	}
	/*foreach($first_data As $key)
	{
		if( in_array($key, $requireCols) ) {
			$html .= '<input type="hidden" id="filter_min_' . $key . '" ng-model="filter_min_' . $key . '" value="' . $data_agg['aggregrate']['filter_min_' . $key] . '" />';
			$html .= '<input type="hidden" id="filter_max_' . $key . '" ng-model="filter_max_' . $key . '" value="' . $data_agg['aggregrate']['filter_max_' . $key] . '" />';	
		}
	}*/
	
	$html .= '<div class="mt-3" >Records found (' . $rec_count . ')</div>';
	$html .= '<input type="hidden" name="hid_total_rec" id="hid_total_rec" ng-model="total_rec" value="' . $rec_count . '" />';
	$html .= '<div class="table-responsive">';
	$html .= '<table class="table table-sm table-striped table-hover" ><thead><tr>';
					if( is_user_logged_in() )
						$html .= '<th class="d-none" ><i class="fas fa-eye"></i> Watchlist</th>';
					foreach($first_data As $key) {
						$keyLabel = $key;
						if($key == 'type')
							$keyLabel = 'Structure';
						if($key == 'category')
							$keyLabel = 'Major Group';
						if($key == 'group')
							$keyLabel = 'Sub-group';
						if($key == 'earliest_inception')
							$keyLabel = 'Inception';
						if($key == 'managed_assets_m')
							$keyLabel = 'Managed Assets (MM)';
						if($key == 'exp_ratio_net_av')
							$keyLabel = 'Avg Net Expense Ratio';	
						if($key == 'leverage_fundamental')
							$keyLabel = 'Leverage (%)';	
						if($key == 'div_freq')
							$keyLabel = 'Dividend Frequency';
						if($key == 'nav_yield_av')
							$keyLabel = 'Avg NAV Yield';
						if($key == 'tr_3mo_av')
							$keyLabel = 'Total Return (3mo)';
						if($key == 'tr_ytd_av')
							$keyLabel = 'Total Return (YTD)';
						if($key == 'tr_1yr_av')
							$keyLabel = 'Total Return (1yr)';
						if($key == 'tr_3yr_av')
							$keyLabel = 'Total Return (3yr)';
						if($key == 'tr_5yr_av')
							$keyLabel = 'Total Return (5yr)';
						if($key == 'num_classes')
							$keyLabel = 'Number of Share Classes';
		
						$html .= '<th class="tab-col-' . $key . ' ' . (($_SESSION['order_head'] == $key || $_SESSION['order_head'] == '-' . $key . '') ? 'order-column-th' : '') . (in_array($key,$requireCols) ? '' : (is_user_logged_in() ? ' d-none' : '')) . '" ><a class="a_order " data-head="' . (!empty($_SESSION['order_head']) ? ($_SESSION['order_head'] == $key ? '-' . $key : $key) : '-' . $key) . '" >' . ucwords(str_replace('_', ' ', $keyLabel)) . '</a></th>';
					}
	$html .= '</tr></thead>';
	$html .= '<tbody>';
	foreach($data As $key => $dat)
	{
		$html .= '<tr ' . (!empty($dat['id']) && !empty($vWatchlist) ? (in_array($dat['id'], $vWatchlist) ? 'class="watchlist_row"' : '') : '') . '>';
		if( is_user_logged_in() ) {
			$html .= '<td class="d-none" ><input class="nlwatchlist" type="checkbox" ng-model="chbx_nf_' . (!empty($dat['id']) ? $dat['id'] : 'none') . '" ng-checked="' . (!empty($dat['id'] && !empty($vWatchlist)) ? (in_array($dat['id'], $vWatchlist) ? 'true' : 'false') : '') . '" value="' . (!empty($dat['id']) ? $dat['id'] : 'none') . '" ng-click="clicknfWatchlist()" ' . (!empty($dat['id']) && !empty($vWatchlist) ? (in_array($dat['id'], $vWatchlist) ? 'checked' : '') : '') . ' /></td>';
		}
			foreach($first_data As $key) {
				$html .= '<td class="tab-col-' . $key . ' ' . (($_SESSION['order_head'] == $key || $_SESSION['order_head'] == '-' . $key . '') ? 'order-column-td' : '') . (in_array($key,$requireCols) ? '' : (is_user_logged_in() ? ' d-none' : '')) . '" >' . ($key == 'name' ? '<a target="_blank" href="/non-listed-fund-profile?id=' . (!empty($dat['id']) ? $dat['id'] : '0' ) .  '">' : '') . (!empty($dat[$key]) ? ($key == 'type' ? ($dat[$key] == 'I' ? 'Interval Fund' : 'Tender Offer Fund') : ($key == 'earliest_inception' ? date('m/d/Y', strtotime($dat[$key])) : $dat[$key]) ) : '') . ($key == 'name' ? '</a>' : '') .  '</td>';
			}
		$html .= '</tr>';		
	}
	$html .= '</tbody>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '</div>';
?>