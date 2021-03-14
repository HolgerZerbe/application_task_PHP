<table class= "general_table">
    <thead>
        <tr>
            <td>Salutation</td><td>First name</td><td>Last name</td><td>Telephone</td><td>Email</td>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($tableData as $data): ?>

            <tr>
                <td><?=$data["salutation"] ?></td>
                <td><?=ucfirst($data["firstName"]) ?></td>
                <td><?=ucfirst($data["lastName"]) ?></td>
                <td><?=$data["telephone"] ?></td>
                <?php if ($data["email"] === "incorrect email" || $data["email"] === "") { ?>
                    <td><?=$data["email"] ?></td> 
                <?php } else { ?>
                    <td><a href mailto ='<?=$data["email"] ?>'><?=$data["email"] ?></a></td>
                    <?php } ?>
                
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>