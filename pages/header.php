<!DOCTYPE html>
<?php
include_once('../function.php');
session_start();

if($_SESSION['id'] == '')
{
	header("Location:../index.php");
}

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Trade Channel admin pannel</title>

        <!-- Bootstrap Core CSS -->
        <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../assets/admin/css/metisMenu.min.css" rel="stylesheet">
<link href="../assets/admin/css/jquery.Jcrop.min.css" rel="stylesheet">
        <!-- Timeline CSS -->
        <link href="../assets/admin/css/timeline.css" rel="stylesheet">
		 <!-- DataTables CSS -->
        <link href="../assets/admin/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../assets/admin/css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../assets/admin/css/startmin.css" rel="stylesheet">
		


        <!-- Morris Charts CSS -->
		<link href="../assets/admin/css/morris.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css">


		<!-- Custom Fonts -->
		<link href="../assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<script src="../assets/admin/js/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="../assets/admin/js/jquery.Jcrop.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
		<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    </head>
<body>
<div id="wrapper">
<?php include('leftsidebar.php'); ?>