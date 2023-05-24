<?php
include_once 'functions/Common.php';
?>
<style>
<!--
body {
	padding: 75px 0px 75px 0px;
}

a {
	text-decoration: none;
	color: #008A12;
}

a:HOVER {
	text-decoration: underline;
	color: #008A12;
}

a:ACTIVE {
	text-decoration: none;
	color: #008A12;
}

.tblHdr {
	border: 0px solid black;
	width: 100%;
	padding: 10px 5px 5px 10px;
	display: inline;
}

table td {
	text-align: center;
	border: 1px solid black;
	padding: 5px;
}

input {
	width: 95%;
}

input[type="radio"] {
	align: left;
	width: 10%;
}

.divBev {
    border: 2.5px solid #008A12;
	background-color: #E8FFEB;
	border-radius: 10px;
	color: 00610d;
	width: 150px;
	height: 27px;
	font-weight: bold;
	display: table;
    vertical-align: middle;
    padding-top: 5px;
}

.devHeader {
	position: fixed;
	top: 0px;
	width: 100%;
	background-color: #FFF;
	border-bottom: #008A12 5px double;
}

.messageOK {
	color:#001EB5;
}

.headerIcone {
	 vertical-align:middle;
	 padding: 0px 5px 5px 0px;
}

-->
</style>
<div class=devHeader>
	<div style="display: inline;">
		<a href="index.php"><img src='icons/apache-php-mysql.jpg' height="58" /></a>
	</div>
	<table class="tblHdr">
		<tr>
			<td style="border: none">
				<a href="index.php">
				    <div class=divBev><img alt="" src="icons/database.png" class=headerIcone width=20 height=23>DB Status</div>
                </a>
			</td>
			<td style="border: none">
				<a href="PersonList.php">
				    <div class=divBev><img alt="" src="icons/person.png" class=headerIcone width=20 height=20>Person List</div></a>
			</td>
			<td style="border: none">
				<a href="PersonAdd.php">
				    <div class=divBev><img alt="" src="icons/add.png" class=headerIcone width=20 height=20>Add Person</div></a>
			</td>
			<td style="border: none">
				<a href="PropertyList.php">
				    <div class=divBev><img alt="" src="icons/property.png" class=headerIcone width=18 height=18>Property List</div></a>
			</td>
			<td style="border: none">
				<a href="PropertyAdd.php">
				    <div class=divBev><img alt="" src="icons/PropertyAdd.png" class=headerIcone width=18 height=18>Add Property</div></a></td>
		</tr>
	</table>
</div>