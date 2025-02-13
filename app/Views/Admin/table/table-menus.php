<?php
$this->db = \Config\Database::connect();
$no = 1;
foreach ($menu as $l):
    $menusAccess = $this->db->table('menus_access')->where(['role_name' => 'Kasir', 'menu_id' => $l['id']])->get()->getRowArray();
?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $l['menu_name'] ?></td>
        <td><?= $l['menu_order'] ?></td>
        <td><input type="checkbox" <?php if (!empty($menusAccess)) {
                                        echo 'checked';
                                    } ?> id="check-access" data-id="<?= $l['id'] ?>"></td>
    </tr>
<?php endforeach; ?>