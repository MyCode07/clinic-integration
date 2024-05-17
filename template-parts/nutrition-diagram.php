<?php if ($diary['calorieDistributionOfMeals']) : ?>
    <div class="nutrition-diagram__item" id="calorie-intake">
        <div class="nutrition-diagram__item-top">
            <h3>Распределение калорийности рациона по приёмам пищи</h3>
        </div>
        <div class="nutrition-diagram__item-bottom">
            <div class="canvas">
                <canvas></canvas>
            </div>
            <table>
                <tbody>
                    <?php $i = 0;
                    foreach ($diary['calorieDistributionOfMeals'] as $item) : ?>
                        <tr>
                            <td class="percent" data-color="<?php echo $colors[$i] ?>" style="--color:<?php echo $colors[$i] ?>"><?php echo $item['percent'] ?>%</td>
                            <td><?php echo $item['ingestion'] ?></td>
                            <td><?php echo $item['energy'] ?> ккал</td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php if ($diary['ratioPFC']) : ?>
    <div class="nutrition-diagram__item" id="ptc">
        <div class="nutrition-diagram__item-top">
            <h3>Соотношение БЖУ в рационе</h3>
        </div>
        <div class="nutrition-diagram__item-bottom">
            <div class="canvas">
                <canvas></canvas>
            </div>
            <table>
                <tbody>
                    <tr class="proteins">
                        <td class="percent" data-color="#02A0FC" style="--color:#02A0FC"><?php echo $diary['ratioPFC']['proteinPercent'] ?>%</td>
                        <td>Белки</td>
                        <td><?php echo $diary['ratioPFC']['protein'] ?> ккал</td>
                    </tr>
                    <tr class="fats">
                        <td class="percent" data-color="#7FCEFB" style="--color:#7FCEFB"><?php echo $diary['ratioPFC']['fatsPercent'] ?>%</td>
                        <td>Жиры</td>
                        <td><?php echo $diary['ratioPFC']['fat'] ?> ккал</td>
                    </tr>
                    <tr class="carbohydrates">
                        <td class="percent" data-color="#D26256" style="--color:#D26256"><?php echo $diary['ratioPFC']['carbohydratePercent'] ?>%</td>
                        <td>Углеводы</td>
                        <td><?php echo $diary['ratioPFC']['carbohydrate'] ?> ккал</td>
                    </tr>
                    <tr class="ptc">
                        <td class="percent" data-color="#E3A098" style="--color:#E3A098"><?php echo $diary['ratioPFC']['ratio'] ?></td>
                        <td>Б/Ж/У</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php if ($diary['percentCarbohydrates']) : ?>
    <div class="nutrition-diagram__item" id="carbohydrates">
        <div class="nutrition-diagram__item-top">
            <h3>Состав углеводов</h3>
        </div>
        <div class="nutrition-diagram__item-bottom">
            <div class="canvas">
                <canvas></canvas>
            </div>
            <table>
                <tbody>
                    <tr class="sugars">
                        <td class="percent" data-color="#02A0FC" style="--color:#02A0FC">45%</td>
                        <td>Простые сахара</td>
                        <td><?php echo $diary['percentCarbohydrates']['simpleCarbohydrates'] ?> г</td>
                    </tr>
                    <tr class="starch">
                        <td class="percent" data-color="#7FCEFB" style="--color:#7FCEFB">45%</td>
                        <td>Крахмал</td>
                        <td><?php echo $diary['percentCarbohydrates']['starch'] ?> г</td>
                    </tr>
                    <tr class="cellulose">
                        <td class="percent" data-color="#D26256" style="--color:#D26256">45%</td>
                        <td>Клетчатка</td>
                        <td><?php echo $diary['percentCarbohydrates']['fiber'] ?> г</td>
                    </tr>
                    <tr class="complex-carbohydrates">
                        <td class="percent" data-color="#E3A098" style="--color:#E3A098">45%</td>
                        <td>Прочие сложные углеводы</td>
                        <td><?php echo $diary['percentCarbohydrates']['otherCarbohydrates'] ?> г</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php if ($show_section) : ?>
    <div class="nutrition-diagram__item" id="added-sugar">
        <div class="nutrition-diagram__item-top">
            <h3>Доля добавленного сахара в общей калорийности рациона</h3>
        </div>
        <div class="nutrition-diagram__item-bottom">
            <div class="canvas">
                <canvas></canvas>
            </div>
            <table>
                <tbody>
                    <tr class="added-sugar">
                        <td class="percent" data-color="#02A0FC" style="--color:#02A0FC">45%
                        </td>
                        <td>Добавлен-ный сахар</td>
                        <td>893 ккал</td>
                    </tr>
                    <tr class="caloric-substances">
                        <td class="percent" data-color="#7FCEFB" style="--color:#7FCEFB">45%
                        </td>
                        <td>Остальные калорийные вещества</td>
                        <td>893 ккал</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
<?php endif; ?>

<?php if ($diary['ratioOmegas']) : ?>
    <div class="nutrition-diagram__item" id="omegas">
        <div class="nutrition-diagram__item-top">
            <h3>Соотношение Омега-3/Омега-6</h3>
        </div>
        <div class="nutrition-diagram__item-bottom">
            <div class="canvas">
                <canvas></canvas>
            </div>
            <table>
                <tbody>
                    <tr class="omega-3">
                        <td class="percent" data-color="#02A0FC" style="--color:#02A0FC"><?php echo $diary['ratioOmegas']['omega3Percent'] ?>%</td>
                        <td>Омега-3</td>
                        <td><?php echo $diary['ratioOmegas']['omega3'] ?> <?php echo $diary['ratioOmegas']['unit'] ?></td>
                    </tr>
                    <tr class="omega-6">
                        <td class="percent" data-color="#7FCEFB" style="--color:#7FCEFB"><?php echo $diary['ratioOmegas']['omega6Percent'] ?>%</td>
                        <td>Омега-6</td>
                        <td><?php echo $diary['ratioOmegas']['omega6'] ?> <?php echo $diary['ratioOmegas']['unit'] ?></td>
                    </tr>
                    <tr class="omega-3-6">
                        <td class="percent" data-color="#D26256" style="--color:#D26256"><?php echo $diary['ratioOmegas']['ratio'] ?></td>
                        <td>Омега-3/Омега-6</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
<?php endif; ?>

<?php if ($diary['ratioSodiumPotassium']) : ?>
    <div class="nutrition-diagram__item" id="sodium-potassium">
        <div class="nutrition-diagram__item-top">
            <h3>Соотношение Натрий/Калий</h3>
        </div>
        <div class="nutrition-diagram__item-bottom">
            <div class="canvas">
                <canvas></canvas>
            </div>
            <table>
                <tbody>
                    <tr class="sodium">
                        <td class="percent" data-color="#02A0FC" style="--color:#02A0FC"><?php echo $diary['ratioSodiumPotassium']['sodiumPercent'] ?>%</td>
                        <td>Натрий</td>
                        <td><?php echo $diary['ratioSodiumPotassium']['sodium'] ?> <?php echo $diary['ratioSodiumPotassium']['unit'] ?></td>
                    </tr>
                    <tr class="potassium">
                        <td class="percent" data-color="#7FCEFB" style="--color:#7FCEFB"><?php echo $diary['ratioSodiumPotassium']['potassiumPercent'] ?>%</td>
                        <td>Калий</td>
                        <td><?php echo $diary['ratioSodiumPotassium']['potassium'] ?> <?php echo $diary['ratioSodiumPotassium']['unit'] ?></td>
                    </tr>
                    <tr class="sodium-potassium">
                        <td class="percent" data-color="#D26256" style="--color:#D26256"><?php echo $diary['ratioSodiumPotassium']['ratio'] ?></td>
                        <td>Натрий/Калий</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php if ($diary['ratioCalciumPhosphorusMagnesium']) : ?>
    <div class="nutrition-diagram__item" id="calcium-phosphorus-magnesium">
        <div class="nutrition-diagram__item-top">
            <h3>Соотношение Кальций/Фосфор/Магний</h3>
        </div>
        <div class="nutrition-diagram__item-bottom">
            <div class="canvas">
                <canvas></canvas>
            </div>
            <table>
                <tbody>
                    <tr class="calcium">
                        <td class="percent" data-color="#02A0FC" style="--color:#02A0FC"><?php echo $diary['ratioCalciumPhosphorusMagnesium']['calciumPercent'] ?>%</td>
                        <td>Кальций</td>
                        <td><?php echo $diary['ratioCalciumPhosphorusMagnesium']['calcium'] ?> <?php echo $diary['ratioCalciumPhosphorusMagnesium']['unit'] ?></td>
                    </tr>
                    <tr class="phosphorus">
                        <td class="percent" data-color="#7FCEFB" style="--color:#7FCEFB"><?php echo $diary['ratioCalciumPhosphorusMagnesium']['phosphorusPercent'] ?>%</td>
                        <td>Фосфор</td>
                        <td><?php echo $diary['ratioCalciumPhosphorusMagnesium']['phosphorus'] ?> <?php echo $diary['ratioCalciumPhosphorusMagnesium']['unit'] ?></td>
                    </tr>
                    <tr class="magnesium">
                        <td class="percent" data-color="#D26256" style="--color:#D26256"><?php echo $diary['ratioCalciumPhosphorusMagnesium']['magnesiumPercent'] ?>%</td>
                        <td>Магний</td>
                        <td><?php echo $diary['ratioCalciumPhosphorusMagnesium']['magnesium'] ?> <?php echo $diary['ratioCalciumPhosphorusMagnesium']['unit'] ?></td>
                    </tr>
                    <tr class="calcium-phosphorus-magnesium">
                        <td class="percent" data-color="#B7B7B7" style="--color:#B7B7B7"><?php echo $diary['ratioCalciumPhosphorusMagnesium']['ratio'] ?></td>
                        <td>Кальций/Фосфор/Магний</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
<?php endif; ?>