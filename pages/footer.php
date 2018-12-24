 </div>
        <!-- jQuery -->
    

        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/admin/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../assets/admin/js/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
		<script src="../assets/admin/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../assets/admin/js/dataTables/dataTables.bootstrap.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="../assets/admin/js/startmin.js"></script>
		<script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
					"language": {
						"emptyTable": "No trade shows available"
						},
						"ordering": false,
                        responsive: true
                });
            });
        </script>
    </body>
</html>