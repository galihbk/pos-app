<?php
$no = 1;
foreach ($user as $l): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $l['username'] ?></td>
        <td><?= $l['name'] ?></td>
        <td><?= $l['created_at'] ?></td>
        <td><?= $l['updated_at'] ?></td>
        <td class="text-center"><button class="btn btn-danger" id="btn-delete" data-id="<?= $l['id'] ?>"><i class="bx bx-trash"></i></button> <button id="btn-edit" data-id="<?= $l['id'] ?>" class="btn btn-primary"><i class="bx bx-edit"></i></button> <button id="btn-edit-password" data-id="<?= $l['id'] ?>" class="btn btn-secondary"><i class="bx bx-lock"></i></button></td>
    </tr>
<?php endforeach; ?>