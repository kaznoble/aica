<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >Portfolio Data</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
if( !empty($get_fund_info[0]['maturity']) ) {
$html .= '<tr>';
$html .= '<td>Maturity (' . $get_fund_info[0]['maturity_date'] . ')</td>';
$html .= '<td>' . $get_fund_info[0]['maturity'] . '</td>';
$html .= '</tr>';
}
if( !empty($get_fund_info[0]['duration']) ) {
$html .= '<tr>';
$html .= '<td>Duration (' . $get_fund_info[0]['duration_date'] . ')</td>';
$html .= '<td>' . $get_fund_info[0]['duration'] . '</td>';
$html .= '</tr>';
}
if( !empty($get_fund_info[0]['unii']) ) {
$html .= '<tr>';
$html .= '<td>UNII / Share (' . date('M. d, Y', strtotime($get_fund_info[0]['assets_date'])) . ')</td>';
$html .= '<td>' . number_format($get_fund_info[0]['unii'], 3, '.', '') . '</td>';
$html .= '</tr>';
}
if( !empty($get_fund_info[0]['turnover_rate']) ) {
$html .= '<tr>';
$html .= '<td>Turnover Rate (' . date('M. d, Y', strtotime($get_fund_info[0]['assets_date'])) . ')</td>';
$html .= '<td>$' . $get_fund_info[0]['turnover_rate'] . '</td>';
$html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>