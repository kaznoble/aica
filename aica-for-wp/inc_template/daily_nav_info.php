<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-sm table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="5" >Daily NAV</th>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th>Ticker</th>';
$html .= '<th>NAV / share</th>';
$html .= '<th>Net Assets</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
foreach($get_fund_info As $info) {
$html .= '<tr>';
$html .= '<td>' . $info['ticker'] . '</td>';
$html .= '<td>$' . $info['current_nav'] . '</td>';
$html .= '<td>$' . $info['current_net_assets_m'] . 'M</td>';
$html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>