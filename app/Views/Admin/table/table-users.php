<?php
$no = 1;
foreach ($user as $l): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $l['name'] ?></td>
        <td><?= $l['username'] ?></td>
        <td><?= $l['created_at'] ?></td>
        <td><?= $l['updated_at'] ?></td>
        <td><button class="btn btn-danger"><i class="bx bx-trash"></i></button></td>
    </tr>
<?php endforeach; ?>