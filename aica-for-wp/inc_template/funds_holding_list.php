<?php
	// Set initial columns
	$fundColumns = ['Name'=>'full_name','Date'=>'holding_date','Price'=>'holding_price','Shares'=>'holding_shares','Price change since purchase'=>'holding_change_price','Total Distributions'=>'holding_distribution','Actions'=>'actions'];

	// Get first row data with column name
	if( !empty($data) ) {	
		$first_data = array_keys($data[0]);
		array_shift($first_data);
		foreach($first_data As $key)
		{
			//$html .= '<input type="hidden" id="filter_min_' . $key . '" ng-model="filter_min_' . $key . '" value="' . (!empty($data_agg['aggregrate']['filter_min_' . $key]) ? $data_agg['aggregrate']['filter_min_' . $key] : '') . '" />';
			//$html .= '<input type="hidden" id="filter_max_' . $key . '" ng-model="filter_max_' . $key . '" value="' . (!empty($data_agg['aggregrate']['filter_max_' . $key]) ? $data_agg['aggregrate']['filter_max_' . $key] : '') . '" />';		
		}
	}
	if( !empty($rec_count) && !$viewWatchList ) {
		$html .= '<div class="mt-3" >Records found (' . $rec_count . ') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; * <span class="font-italic" style="font-size:0.8em;" >Beta and Correlation data is based on <a href="https://cefdata.com/index/details/412/" target="_blank">CEF Advisors’ 12 Major Sector Index</a> market price data</span></div>';
	}
	$html .= '<input type="hidden" name="hid_total_rec" id="hid_total_rec" ng-model="total_rec" value="' . $rec_count . '" />';
	$html .= '<div class="table-responsive">';
	$html .= '<table class="table table-sm table-striped table-hover" ><thead><tr>';
						if( is_user_logged_in() ) {
							$html .= '<th class="d-none" ><i class="fas fa-eye "></i> Portfolios</th>';
						}
						$html .= '<th class="headcol tab-col-ticker ' . (($_SESSION['order_head'] == 'ticker' || $_SESSION['order_head'] == '-ticker') ? 'order-column-th' : '') . '" >Ticker</th>';
						foreach($fundColumns As $key => $fundCol) {
							$html .= '<th class="tab-col-' . $fundCol . '" >' . ucwords(str_replace('_',' ',$key)) . '</th>';
						}
	$html .= '</thead></tr>';

	// Get user's portfolio
	if( is_user_logged_in() ) {
		$resPort = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'user_portfolio WHERE user_id = ' . $user_id));
		$resPort = json_decode(json_encode($resPort), true);
	}

	$row = 1;
	foreach($data As $key => $dat)
	{
		$html .= '<tr class="tr_fund_row" >';
		if( is_user_logged_in() ) {
			$html .= '<td class="' . (!empty($dat['id'])  && !empty($allWatchlist) ? (in_array($dat['id'], $allWatchlist) ? 'watchlist_row' : '') : '')  . ' d-none" >';
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
		$html .= '<td colspan="5" ></td>';
		$html .= '<td><button class="btn btn-info btn-sm butt_purchase" data-id="' . $dat['id'] . '" ><i class="fas fa-plus"></i>&nbsp;ADD PURCHASE</button></td>';
		$html .= '</tr>';
		
		// Holding table
		$existHolding = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'user_holding WHERE fund_id=%d AND port_id=%d', $dat['id'], (!empty($request->port_id) ? $request->port_id : $portOptRes[0]->port_id) ));
		if( !empty($existHolding) ) {
			foreach($existHolding As $existHold) {
				$html .= '<tr class=" tr_purchase_' . $dat['id'] . ' tr_holding" style="' . (!empty($existHolding) ? '' : 'display:none;') . '" >';
				$html .= '<td colspan="2" ></td>';
				$html .= '<td ><input class="form-control txt_hold_date datepicker" data-row="' . $row . '" data-fundid="' . $dat['id'] . '" type="text" name="txt_purc_date_' . $row . '" id="txt_purc_date_' . $row . '" placeholder="mm/dd/yyyy" disabled value="' . date('m/d/Y', strtotime($existHold->holding_date)) . '" /></td>';
				$html .= '<td ><input class="form-control" data-fundid="' . $dat['id'] . '" type="text" name="txt_purc_price_' . $row . '" id="txt_purc_price_' . $row . '" disabled value="' . $existHold->holding_price . '" /></td>';
				$html .= '<td ><input class="form-control txt_hold_share" data-row="' . $row . '" data-fundid="' . $dat['id'] . '" type="text" name="txt_purc_shares_' . $row . '" id="txt_purc_shares_' . $row . '" disabled value="' . $existHold->holding_shares . '" /></td>';
				$html .= '<td class="price_change_' . $row . '">$' . number_format($existHold->holding_price_change, 2, '.', '') . '</td>';
				$html .= '<td class="distribution_' . $row . '">$' . number_format($existHold->holding_distr, 2, '.', '') . '</td>';
				$html .= '<td ><button class="butt_purc_update update_' . $existHold->holding_id . ' btn btn-secondary btn-sm mb-2" data-holdid="' . $existHold->holding_id . '" data-row="' . $row . '" data-id="' . $dat['id'] . '" >UPDATE</button><button class="butt_purc_delete delete_' . $existHold->holding_id . ' btn btn-light btn-sm" data-holdid="' . $existHold->holding_id . '" data-row="' . $row . '" data-id="' . $dat['id'] . '" ><i class="fas fa-trash-alt"></i>&nbsp;DELETE</button><button class="butt_purc_save save_' . $existHold->holding_id . ' btn btn-primary btn-sm d-none mb-2" data-holdid="' . $existHold->holding_id . '" data-row="' . $row . '" data-id="' . $dat['id'] . '" >SAVE</button><button class="butt_purc_cancel cancel_' . $existHold->holding_id . ' btn btn-dark btn-sm d-none" data-holdid="' . $existHold->holding_id . '" data-row="' . $row . '" data-id="' . $dat['id'] . '" >CANCEL</button><input type="hidden" id="hid_price_change_' . $row . '" value="" /><input type="hidden" id="hid_distributions_' . $row . '" value="" /></td>';			
				$html .= '</tr>';
				$row++;
			}
		}
	}
		
	$html .= '</table>';
	$html .= '</div>';
	$html .= '</div>';
?>