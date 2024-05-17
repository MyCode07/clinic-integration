<div class="grid grid-3">
    <div class="grid-item">
        <?php if ($patient['meta']['chronicDiseases']) : ?>
            <div class="params-item">
                <div class="params-item__flex">
                    <div class="params-item__left">
                        <div class="icon">
                            <svg width="30" height="27" viewBox="0 0 30 27">
                                <use xlink:href='assets/img/svg/icons.svg#heart' />
                            </svg>
                        </div>
                    </div>
                    <div class="params-item__right">
                        <label>Хронические заболевания</label>
                    </div>
                </div>
                <div class="params-item__text">
                    <div class="params-item__extra">
                        <ol>
                            <?php foreach ($patient['meta']['chronicDiseases'] as $item) : ?>
                                <li><?php echo $item ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($patient['meta']['stress']) : ?>
            <div class="params-item">
                <div class="params-item__flex">
                    <div class="params-item__left">
                        <div class="icon">
                            <svg width="20" height="28" viewBox="0 0 20 28">
                                <use xlink:href='assets/img/svg/icons.svg#lightning' />
                            </svg>
                        </div>
                    </div>
                    <div class="params-item__right">
                        <label>Уровень стресса</label>
                    </div>
                </div>
                <div class="params-item__text">
                    <div class="params-item__extra">
                        <p>
                            <?php echo $patient['meta']['stress'] ?>
                            <svg width="15" height="15" viewBox="0 0 15 15">
                                <use xlink:href='assets/img/svg/icons.svg#arrow-down' />
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($patient['meta']['allergy']['product']['products'] || $patient['meta']['allergy']['medicine']['medicine']) : ?>
        <div class="params-item">
            <div class="params-item__flex">
                <div class="params-item__left">
                    <div class="icon">
                        <svg width="27" height="27" viewBox="0 0 27 27">
                            <use xlink:href='assets/img/svg/icons.svg#stop' />
                        </svg>
                    </div>
                </div>
                <div class="params-item__right">
                    <label>Аллергии</label>
                </div>
            </div>
            <div class="params-item__text">
                <div class="params-item__extra">
                    <?php if ($patient['meta']['allergy']['product']['products']) : ?>
                        <label>Продукты питания:</label>
                        <ol>
                            <?php foreach ($patient['meta']['allergy']['product']['products'] as $item) : ?>
                                <li><?php echo $item ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endif; ?>

                    <?php if ($patient['meta']['allergy']['medicine']['medicine']) : ?>
                        <label>Лекарства и БАДы:</label>
                        <ol>
                            <?php foreach ($patient['meta']['allergy']['medicine']['medicine'] as $item) : ?>
                                <li><?php echo $item ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endif; ?>

                    <?php if ($patient['meta']['allergy']['other']['other']) : ?>
                        <label>Другое:</label>
                        <ol>
                            <?php foreach ($patient['meta']['allergy']['other']['other'] as $item) : ?>
                                <li><?php echo $item ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid-item">
        <?php if ($patient['meta']['specialStates']) : ?>
            <div class="params-item">
                <div class="params-item__flex">
                    <div class="params-item__left">
                        <div class="icon">
                            <svg width="30" height="30" viewBox="0 0 30 30">
                                <use xlink:href='assets/img/svg/icons.svg#star' />
                            </svg>
                        </div>
                    </div>
                    <div class="params-item__right">
                        <label>Особые состояния</label>
                    </div>
                </div>
                <div class="params-item__text">
                    <div class="params-item__extra">
                        <?php foreach ($patient['meta']['specialStates'] as $item) : ?>
                            <li><?php echo $item ?></li>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($patient['meta']['badHabits']) : ?>
            <div class="params-item">
                <div class="params-item__flex">
                    <div class="params-item__left">
                        <div class="icon">
                            <svg width="27" height="23" viewBox="0 0 27 23">
                                <use xlink:href='assets/img/svg/icons.svg#attention' />
                            </svg>
                        </div>
                    </div>
                    <div class="params-item__right">
                        <label>Вредные привычки</label>
                    </div>
                </div>
                <div class="params-item__text">
                    <div class="params-item__extra">
                        <?php foreach ($patient['meta']['badHabits'] as $item) : ?>
                            <?php if ($item['answer'] == 'Да') : ?>
                                <li>
                                    <?php
                                    if ($item['amount']) {
                                        echo $item['amount'] . ' ';
                                    }

                                    echo $item['unit'];
                                    ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="params-item params-info large">
        <div class="params-item__wrap">
            <div class="icon">
                <svg width="48" height="48" viewBox="0 0 48 48">
                    <use xlink:href='assets/img/svg/icons.svg#info' />
                </svg>
            </div>
            <h3>Заключение</h3>
            <p>У вас наблюдается умеренно выраженный стресс. Это требует коррекции, поскольку в
                таких
                условиях может повышаться риск
                развития сердечно-сосудистых заболеваний, ожирения, диабета 2-го типа,
                хронической
                усталости и других состояний. А
                наличие вредных привычек может негативно сказываться на вашем здоровье,
                самочувствии и
                препятствовать достижению цели.</p>
        </div>
    </div>
</div>