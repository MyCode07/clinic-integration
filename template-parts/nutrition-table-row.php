<tr class="<?php echo $class ?>">
    <?php if ($i == 0) : ?>
        <td><b><?php echo $item['title'] ?></b></td>
    <?php else : ?>
        <td><?php echo $item['title'] ?></td>
    <?php endif; ?>
    <td style="--width:<?php echo $item['percent'] ?>%">1 <?php echo $item['unit'] ?></td>
    <td><?php echo $item['percent'] ?>%</td>
</tr>