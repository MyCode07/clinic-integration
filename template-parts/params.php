<div class="params-flex">
    <div class="params-flex__image">
        <ol>
            <?php if ($patient['chest']) : ?>
                <li id="params-brest">
                    <span>Грудь</span>
                    <img class="_desctop" src="assets/img/icons/brest.svg" alt="">
                    <img class="_mobile" src="assets/img/icons/brest-mob.svg" alt="">
                    <span><?php echo $patient['chest'] ?> см</span>
                </li>
            <?php endif; ?>
            <?php if ($patient['waist']) : ?>
                <li id="params-waise">
                    <span>Талия</span>
                    <img class="_desctop" src="assets/img/icons/waist.svg" alt="">
                    <img class="_mobile" src="assets/img/icons/waist-mob.svg" alt="">
                    <span><?php echo $patient['waist'] ?> см</span>
                </li>
            <?php endif; ?>
            <?php if ($patient['wrist']) : ?>
                <li id="params-wrist">
                    <span>Запястье</span>
                    <img class="_desctop" src="assets/img/icons/wrist.svg" alt="">
                    <img class="_mobile" src="assets/img/icons/wrist-mob.svg" alt="">
                    <span><?php echo $patient['wrist'] ?> см</span>
                </li>
            <?php endif; ?>
            <?php if ($patient['hip']) : ?>
                <li id="params-hips">
                    <span>Бёдра</span>
                    <img class="_desctop" src="assets/img/icons/hips.svg" alt="">
                    <img class="_mobile" src="assets/img/icons/hips-mob.svg" alt="">
                    <span><?php echo $patient['hip'] ?> см</span>
                </li>
            <?php endif; ?>
        </ol>
        <div class="img">
            <?php if ($gender == 'female') : ?>
                <img src="assets/img/icons/model.svg" alt="">
            <?php else : ?>
                <img src="assets/img/icons/model-male.svg" alt="">
            <?php endif; ?>
        </div>
    </div>
    <div class="params-flex__content">
        <div class="grid grid-2">
            <div class="params-item">
                <div class="params-item__wrap">
                    <div class="params-item__flex">
                        <div class="params-item__left">
                            <div class="icon">
                                <svg width="39" height="39" viewBox="0 0 39 39">
                                    <use xlink:href='assets/img/svg/icons.svg#mass' />
                                </svg>
                            </div>
                        </div>
                        <div class="params-item__right">
                            <label>Масса тела</label>
                            <span><?php echo $patient['weight'] ?> кг</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="params-item">
                <div class="params-item__wrap">
                    <div class="params-item__flex">
                        <div class="params-item__left">
                            <div class="icon">
                                <svg width="44" height="45" viewBox="0 0 44 45">
                                    <use xlink:href='assets/img/svg/icons.svg#height' />
                                </svg>
                            </div>
                        </div>
                        <div class="params-item__right">
                            <label>Рост</label>
                            <span><?php echo $patient['height'] ?> см</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="params-item">
                <div class="params-item__wrap">
                    <div class="params-item__flex">
                        <div class="params-item__left">
                            <div class="icon">
                                <svg width="48" height="48" viewBox="0 0 48 48">
                                    <use xlink:href='assets/img/svg/icons.svg#imt' />
                                </svg>
                            </div>
                        </div>
                        <div class="params-item__right">
                            <label>ИМТ</label>
                            <span><?php echo $metabolism['indexes']['imt']['value'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="params-item">
                <div class="params-item__wrap">
                    <div class="params-item__flex">
                        <div class="params-item__left">
                            <div class="icon">
                                <svg width="48" height="49" viewBox="0 0 48 49">
                                    <use xlink:href='assets/img/svg/icons.svg#metabolizm' />
                                </svg>
                            </div>
                        </div>
                        <div class="params-item__right">
                            <label>Базовый метаболизм</label>
                            <span><?php echo $metabolism['base_metabolism'] ?> ккал</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="params-item">
                <div class="params-item__wrap">
                    <div class="params-item__flex">
                        <div class="params-item__left">
                            <div class="icon">
                                <svg width="48" height="49" viewBox="0 0 48 49">
                                    <use xlink:href='assets/img/svg/icons.svg#activity' />
                                </svg>
                            </div>
                        </div>
                        <div class="params-item__right">
                            <label>Уровень активности</label>
                        </div>
                    </div>
                    <div class="params-item__extra">
                        <p>
                            <label>Профессия</label>
                            <span><?php echo $patient['working_group'] ?></span>
                        </p>
                        <p>
                            <label>Спорт</label>
                            <span><?php echo $patient['sport'] ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="params-item">
                <div class="params-item__wrap">
                    <div class="params-item__flex">
                        <div class="params-item__left">
                            <div class="icon">
                                <svg width="48" height="48" viewBox="0 0 48 48">
                                    <use xlink:href='assets/img/svg/icons.svg#fat' />
                                </svg>
                            </div>
                        </div>
                        <div class="params-item__right">
                            <label>Процент жира</label>
                            <span><?php echo $metabolism['indexes']['percent_fat']['value'] ?>%*</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="params-text _mobile">* <?php echo $metabolism['indexes']['percent_fat']['info'] ?></div>
            <div class="params-item params-info">
                <div class="params-item__wrap">
                    <div class="icon">
                        <svg width="48" height="48" viewBox="0 0 48 48">
                            <use xlink:href='assets/img/svg/icons.svg#info' />
                        </svg>
                    </div>
                    <span>Комментарии</span>
                    <p>Ваше тело содержит 24% жира, это указывает на хорошую физическую форму.
                        Показатель
                        ИМТ соответствует нормальной массе
                        тела. Дополнительные индексы указывают на: отложение жировых запасов
                        преимущественно
                        на ягодицах и бёдрах и астенический
                        тип телосложения (склонность к худобе от природы). Ваш идеальный вес
                        равен
                        51 кг.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>