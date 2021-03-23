<!DOCTYPE html>
<html>
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

<head>
    <title>Print Customer</title>
</head>

<body>

    <table>
        <tr>

            <th>No</th>
            <th>City </th>
            <th>Prefix </th>
            <th>Phone </th>
            <th>Address</th>
            <th>Email</th>
            <th>Type </th>
            <th>Province </th>
            <th>City </th>
            <th>Subdis </th>
            <th>UV </th>
            <th>Postal Code </th>
            <th>Latitude</th>
            <th>Longtitude</th>
            <th>Created By </th>
            <th>Created Date</th>
            <th>Update By</th>
            <th>Update Date</th>
            <th>Active</th>

        </tr>


        <?php
        $no = 1;
        foreach ($cust as $ctr) : ?>

            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $ctr->customername ?></td>
                <td><?php echo $ctr->customerprefix ?></td>
                <td><?php echo $ctr->customerphone ?></td>
                <td><?php echo $ctr->customeraddress ?></td>
                <td><?php echo $ctr->customeremail ?></td>

                <td><?php echo $ctr->typename ?></td>
                <td><?php echo $ctr->provincename ?></td>
                <td><?php echo $ctr->cityname ?></td>

                <td><?php echo $ctr->customersubdisid ?></td>
                <td><?php echo $ctr->customeruvid ?></td>
                <td><?php echo $ctr->customerpostalcode ?></td>
                <td><?php echo $ctr->customerlatitude ?></td>
                <td><?php echo $ctr->customerlongtitude ?></td>
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