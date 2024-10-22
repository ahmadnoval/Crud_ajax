<!DOCTYPE html>
<html>
<head>
    <title>CRUD with PHP, AJAX and CodeIgniter 3</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<h1>Barang List</h1>

<button id="add_barang">Add Barang</button>

<table border="1" id="barang_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategori</th>
            <th>Barang</th>
            <th>Stok</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- Modal for Add/Edit -->
<div id="modal_form" style="display: none;">
    <input type="hidden" id="id_barang">
    <label>Kategori ID</label><br>
    <input type="text" id="kategori_id"><br>
    <label>Barang</label><br>
    <input type="text" id="barang"><br>
    <label>Stok</label><br>
    <input type="number" id="stok"><br>
    <button id="save">Save</button>
    <button id="close">Close</button>
</div>

<script>
$(document).ready(function() {
    fetchAllBarang();

    function fetchAllBarang() {
        $.ajax({
            url: '<?php echo site_url('BarangController/barang'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let rows = '';
                data.forEach(function(item) {
                    rows += `<tr>
                                <td>${item.id_barang}</td>
                                <td>${item.kategori}</td>
                                <td>${item.barang}</td>
                                <td>${item.stok}</td>
                                <td>
                                    <button class="edit_barang" data-id="${item.id_barang}">Edit</button>
                                    <button class="delete_barang" data-id="${item.id_barang}">Delete</button>
                                </td>
                             </tr>`;
                });
                $('#barang_table tbody').html(rows);
            }
        });
    }

    $('#add_barang').on('click', function() {
        $('#modal_form').show();
        $('#id_barang').val('');
        $('#kategori_id').val('');
        $('#barang').val('');
        $('#stok').val('');
    });

    // Create / Update
    $('#save').on('click', function() {
        const id = $('#id_barang').val();
        const kategori_id = $('#kategori_id').val();
        const barang = $('#barang').val();
        const stok = $('#stok').val();
        const url = id ? '<?php echo site_url('BarangController/update_barang'); ?>' : '<?php echo site_url('BarangController/create_barang'); ?>';

        $.ajax({
            url: url,
            type: 'POST',
            data: { id_barang: id, kategori_id: kategori_id, barang: barang, stok: stok },
            dataType: 'json',
            success: function(response) {
                $('#modal_form').hide();
                fetchAllBarang(); // Refresh the table
            }
        });
    });

    // Edit
    $(document).on('click', '.edit_barang', function() {
        const id = $(this).data('id');
        $.ajax({
            url: '<?php echo site_url('BarangController/get_barang'); ?>',
            type: 'POST',
            data: { id_barang: id },
            dataType: 'json',
            success: function(data) {
                $('#modal_form').show();
                $('#id_barang').val(data.id_barang);
                $('#kategori_id').val(data.kategori_id);
                $('#barang').val(data.barang);
                $('#stok').val(data.stok);
            }
        });
    });

    // Delete
    $(document).on('click', '.delete_barang', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this barang?')) {
            $.ajax({
                url: '<?php echo site_url('BarangController/delete_barang'); ?>',
                type: 'POST',
                data: { id_barang: id },
                dataType: 'json',
                success: function(response) {
                    fetchAllBarang(); // Refresh the table
                }
            });
        }
    });

    $('#close').on('click', function() {
        $('#modal_form').hide();
    });
});
</script>

</body>
</html>
