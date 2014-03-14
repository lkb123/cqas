<div id="PersonTableContainer">

	<script type="text/javascript">
    $(document).ready(function () {
        $('#PersonTableContainer').jtable({
            title: 'Table of people',
            actions: {
                listAction: <?php echo base_url() ?>'GettingStarted/studentList',
                createAction: <?php echo base_url() ?>'GettingStarted/createStudent',
                updateAction: <?php echo base_url() ?>'GettingStarted/updateStudent',
                deleteAction: <?php echo base_url() ?>'GettingStarted/deleteStudent'
            },
            fields: {
                PersonId: {
                    key: true,
                    list: false
                },
                Name: {
                    title: 'Author Name',
                    width: '40%'
                },
                Age: {
                    title: 'Age',
                    width: '20%'
                },
                RecordDate: {
                    title: 'Record date',
                    width: '30%',
                    type: 'date',
                    create: false,
                    edit: false
                }
            }
        });
    });
	</script>

</div>

<?php echo base_url() ?>