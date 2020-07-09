<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-sm table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="7" >Prospectus Data</th>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th>Ticker</th>';
$html .= '<th>Min Investment</th>';
$html .= '<th>Max Load</th>';
$html .= '<th>Early Withdrawal</th>';
$html .= '<th>Mgmt Fee</th>';
$html .= '<th>Other Fees</th>';
$html .= '<th>Waivers</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
foreach($get_fund_info As $info) {
$html .= '<tr>';
$html .= '<td>' . $info['ticker'] . '</td>';
$html .= '<td>' . number_format($info['minimum_investment']) . '</td>';
$html .= '<td>' . $info['max_load'] . '</td>';
$html .= '<td>' . $info['early_withdrawal_fee'] . '</td>';
$html .= '<td>' . $info['mgmt_fee'] . '</td>';
$html .= '<td>' . $info['other_fees'] . '</td>';
$html .= '<td>' . $info['waivers'] . '</td>';
$html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>