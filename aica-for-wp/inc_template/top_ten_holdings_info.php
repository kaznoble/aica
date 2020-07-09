<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >Top 10 Holdings</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
foreach($get_fund_info As $label => $value) {
	$html .= '<tr>';
	$html .= '<td>' . $value['company_name'] . '</td>';
	$html .= '<td>' . $value['allocation'] . '%</td>';
	$html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>