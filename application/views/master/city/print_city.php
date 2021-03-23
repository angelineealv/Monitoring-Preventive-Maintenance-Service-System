<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            text-align: center;
            border: 2px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <title>Print</title>
</head>

<body>

    <table>
        <tr>

            <th>No</th>
            <th>City Name</th>
            <th>Province ID </th>
            <th>Created By </th>
            <th>Created Date</th>
            <th>Update By</th>
            <th>Update Date</th>
            <th>Active</th>

        </tr>


        <?php
        $no = 1;
        foreach ($city as $ctr) : ?>

            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $ctr->cityname ?></td>
                <td><?php echo $ctr->provincename ?></td>
                <td><?php echo $ctr->createdby ?></td>
                <td><?php echo $ctr->createddate ?></td>
                <td><?php echo $ctr->updatedby ?></td>
                <td><?php echo $ctr->updateddate ?></td>
                <td><?php echo $ctr->isactive ?></td>
            </tr>


        <?php endforeach; ?>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>