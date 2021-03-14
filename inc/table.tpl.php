<tr>
    <td><?=$data["salutation"] ?></td>
    <td><?=ucfirst($data["firstName"]) ?></td>
    <td><?=ucfirst($data["lastName"]) ?></td>
    <td><?=$data["telephone"] ?></td>
    <td><a href mailto ="<?=$data['email'] ?>"><?=$data['email'] ?></a></td>
</tr>