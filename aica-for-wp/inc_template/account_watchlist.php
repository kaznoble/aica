<?php
$html .= '<div class="div_watchlist_list" >';
$html .= '<table class="table table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >Funded List Watchlist</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
array_pop($fundids);
foreach($fundids As $list) {
/*	$get_fund_info = callAPI('GET', 'https://cefdata.com/api/nlfunds/?id=' . $list, false);
	$get_fund_info = json_decode($get_fund_info, true);	
	$html .= '<tr>';
	$html .= '<td>' . $get_fund_info[0]['name'] . '</td>';
	$html .= '<td><a href="" class="butt-watchlist butt-watchlist-add fusion-button button-flat fusion-button-default-shape fusion-button-default-size button-default button-11 fusion-button-default-span fusion-button-default-type" data-status="remove" data-id="' . $get_fund_info[0]['id'] . '" data-type="nlfundlist" data-userid="' . $user_id . '" ></i>REMOVE WATCHLIST</a></td>';
	$html .= '</tr>';  */
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>