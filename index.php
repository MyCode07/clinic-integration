<?php

function pre($obj)
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}


function format_num($num, $symbols = 2)
{
    if (!$num) return;

    return number_format($num, $symbols, '.');
}

$json_file = file_get_contents('assets/json.json');

$json = json_decode($json_file, true);

$json_data = $json['data'];

$doctor = $json_data['doctor'];
$doctor_name = $doctor['middle_name'] . ' ' . $doctor['first_name'] . ' ' . $doctor['last_name'];



$patient = $json_data['patient'];
$patient_name = $patient['middle_name'] . ' ' . $patient['first_name'] . ' ' . $patient['last_name'];
$gender = 'male';
if ($patient['gender'] = 1) {
    $gender = 'female';
}

$metabolism = $patient['meta'];
$show_section = false;

$diary = $json_data['diary'];

function calc_to_percent($min, $max, $current, $norm)
{
    if (!$min || !$max || !$current || !$norm) return;


    $norma_percent =  ($norm / $max) * 100;
    $patient_percent = ($current / $max) * 100;

    $norma_percent = format_num($norma_percent);
    $patient_percent = format_num($patient_percent);

    return [
        'norma' => $norma_percent . '%',
        'patient' => $patient_percent . '%',
    ];
}


$colors = [
    '#02A0FC', //      'blue' => 
    '#7FCEFB', // 'lightblue' => 
    '#D26256', //       'red' => 
    '#E3A098', //  'lightred' => 
    '#1F74CA', //  'darkblue' => 
    '#B7B7B7' //       'gray' =>
];

?>

<!DOCTYPE html>
<html lang="<?php echo $json_data['locale'] ?>" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="assets/css/style.min.css?_v=20240507194916">
    <style>
        .calorie-distribution__flex>div {
            min-width: 12%;
        }

        .nutrition-table__item table td:nth-child(2),
        .nutrition-table__item table th:nth-child(2) {
            max-width: 100%;
            /* или еще меньше */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="header__container _container">
                <div class="header__body">
                    <div class="header__logo">
                        <img src="assets/img/logo.png" alt="">
                        <span><?php echo $doctor['work'] ?></span>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="">Параметры тела</a></li>
                            <li><a href="">Фактическое питание</a></li>
                            <li>
                                <a href="">Анализы и заключения</a>
                                <ul>
                                    <li><a href="">Анализы</a></li>
                                    <li><a href="">Заключение и рекомендуемые исследования</a></li>
                                    <li><a href="">Контрольные исследования</a></li>
                                    <li><a href="">Риски развития алиментарных заболеваний</a></li>
                                    <li><a href="">Итоговые заключения</a></li>
                                </ul>
                            </li>
                            <li><a href="">Рекомендуемый рацион</a></li>
                            <li><a href="">Список покупок и рецепты</a></li>
                        </ul>
                    </nav>
                    <button class=" header__burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="hero__bgi">
                    <img src="assets/img/hero.png" alt="">
                </div>
                <div class="hero__container _container">
                    <div class="hero__body">
                        <h1>Персональный отчёт <br> и рекомендации
                            <span>по состоянию здоровья и питанию</span>
                        </h1>
                        <div class="hero__patient">
                            <span class="hero__patient-name"><?php echo $patient_name ?></span>
                            <span class="hero__patient-age"><?php echo $patient['age'] ?> лет</span>
                        </div>
                        <div class="hero__author">
                            <span class="hero__author-name">
                                <span>Составил</span> <?php echo $doctor_name ?>
                            </span>
                            <span class="hero__author-info">
                                <?php
                                echo $doctor['profession'];
                                if ($doctor['title']) {
                                    echo ' ';
                                    echo $doctor['title'];
                                }
                                if ($doctor['post']) {
                                    echo ', ';
                                    echo $doctor['post'];
                                }
                                if ($doctor['work']) {
                                    echo ' ';
                                    echo $doctor['work'];
                                }
                                ?>
                            </span>
                        </div>
                        <div class="hero__date">
                            <?php if ($doctor['city']) : ?>
                                <span><?php echo $doctor['city'] ?></span>
                            <?php endif; ?>
                            <time><?php echo date('d.m.Y') ?></time>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section intro">
                <div class="section__container _container">
                    <div class="section__body">
                        <div class="section__top _center _accent">
                            <h2>
                                <?php
                                if ($gender == 'female') {
                                    echo 'Уважаемая';
                                } else {
                                    echo 'Уважаемый';
                                }
                                ?>
                                <?php echo $patient['middle_name'] . ' ' . $patient['first_name'] ?>
                            </h2>
                        </div>
                        <div>
                            <p>Перед вами ваш персональный отчёт. Это важный шаг на пути к сбалансированному питанию,
                                здоровью и
                                профилактике
                                заболеваний.</p>
                            <p>Рацион и рекомендации разработаны строго под вашу ситуацию. Поэтому они помогут безопасно
                                и
                                комфортно
                                достичь вашу цель.</p>
                            <p>Вся информация в этой «мини-книге» учитывает ваши индивидуальные параметры, пищевые
                                предпочтения,
                                активность, состояние
                                здоровья и запрос по массе тела. Кроме того, вся аналитика, меню и рекомендации в отчёте
                                созданы
                                строго
                                на основе
                                современных научных данных.</p>
                            <p>Приятного изучения и применения!</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section params <?php if ($gender == 'male') echo 'params-male'; ?>">
                <div class="section__linear">
                    <div class="_container">
                        <h2>Параметры и состав тела</h2>
                    </div>
                </div>
                <div class="section__container _container">
                    <div class="section__body">
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
                        <div class="params-text _desctop">* <?php echo $metabolism['indexes']['percent_fat']['info'] ?></div>
                    </div>
                </div>
            </section>

            <?php if ($metabolism['bioimpedansometry']) : ?>
                <section class="section results">
                    <div class="section__container _container">
                        <div class="section__body">
                            <div class="section__top _small">
                                <h2>Результаты биоимпедансного анализа</h2>
                            </div>
                            <div class="results-compare">
                                <span class="results-norm">
                                    <span></span>
                                    <span>Норма</span>
                                </span>
                                <span class="results-patient">
                                    <span></span>
                                    <span>Ваш показатель</span>
                                </span>
                            </div>
                            <div class="grid grid-2">
                                <?php
                                $norma_water = $patient['daily_norms']['water'] / 1000;
                                ?>
                                <div class="result-item">
                                    <h3>Общая жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Внеклеточная жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Общая жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Общая жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Общая жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Общая жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Общая жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Общая жидкость, л</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Соотношение ВКЖ/ОКЖ</h3>
                                    <div class="result-item__flex">
                                        <div class="result-item__score">120</div>
                                        <div class="result-item__scale">
                                            <p>
                                                <span>70</span>
                                                <span>80</span>
                                                <span>90</span>
                                                <span>100</span>
                                                <span>110</span>
                                                <span>120</span>
                                                <span>130</span>
                                                <span>140</span>
                                            </p>
                                            <div style="--norma:calc(100% / 2); --patient:calc((100% / 2) + 10%);" class="red">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="results-text">*Если вам потребуются разъяснения, обратитесь к специалисту.</div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($show_section) : ?>
                <section class="section results results-blue">
                    <div class="section__container _container">
                        <div class="section__body">
                            <div class="grid">
                                <div class="result-item">
                                    <h3>Правая рука</h3>
                                    <div class="grid grid-2">
                                        <div class="result-item__wrap">
                                            <label>Тощая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item__wrap">
                                            <label>Жировая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="result-item">
                                    <h3>Правая рука</h3>
                                    <div class="grid grid-2">
                                        <div class="result-item__wrap">
                                            <label>Тощая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item__wrap">
                                            <label>Жировая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="result-item">
                                    <h3>Туловище</h3>
                                    <div class="grid grid-2">
                                        <div class="result-item__wrap">
                                            <label>Тощая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item__wrap">
                                            <label>Жировая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Правая нога</h3>
                                    <div class="grid grid-2">
                                        <div class="result-item__wrap">
                                            <label>Тощая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item__wrap">
                                            <label>Жировая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="result-item">
                                    <h3>Левая нога</h3>
                                    <div class="grid grid-2">
                                        <div class="result-item__wrap">
                                            <label>Тощая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item__wrap">
                                            <label>Жировая масса по сегментам</label>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120</div>
                                                <div class="result-item__scale">
                                                    <p>
                                                        <span>70</span>
                                                        <span>80</span>
                                                        <span>90</span>
                                                        <span>100</span>
                                                        <span>110</span>
                                                        <span>120</span>
                                                        <span>130</span>
                                                        <span>140</span>
                                                    </p>
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-item__flex">
                                                <div class="result-item__score">120%</div>
                                                <div class="result-item__scale">
                                                    <div style="--norma:calc(100% / 2); --patient:calc(100% / 8);">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="results-text">*Если вам потребуются разъяснения, обратитесь к специалисту.</div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <section class="section results-conclusion">
                <div class="section__container _container">
                    <div class="section__body">
                        <div class="params-item params-info large">
                            <div class="params-item__wrap">
                                <div class="icon">
                                    <svg width="48" height="48" viewBox="0 0 48 48">
                                        <use xlink:href='assets/img/svg/icons.svg#info' />
                                    </svg>
                                </div>
                                <h3>Заключение по биоимпедансному анализу</h3>
                                <p>Ваш фактический рацион не отвечает потребностям вашего организма. Наблюдается дефицит
                                    углеводов, избыток жиров, избыток
                                    белка. 52.4% важнейших для здоровья элементов содержатся в вашем рационе в
                                    необходимом
                                    количестве. Несмотря на это,
                                    следующие витамины и минералы поступают в недостаточном количестве: витамин A,
                                    бета-каротин,
                                    витамин D, витамин E,
                                    витамин K, витамин С, холин, витамин В5, витамин В9, кальций, железо, калий, хлор,
                                    бор, йод.
                                    В вашем фактическом рационе
                                    преобладают такие группы продуктов, как овощи и молочные продукты. Анализ состава
                                    жирных
                                    кислот показал допустимое
                                    соотношение омега-3/омега-6. Желательно повысить употребление продуктов, богатых
                                    омега-3
                                    жирными кислотами для
                                    достижения оптимального соотношения омега-3/омега-6. Вы потребляете оптимальное
                                    количество
                                    простых сахаров. В вашем
                                    рационе недостаточно клетчатки. Это снижает ваше насыщение, ухудшает пищеварение и
                                    повышает
                                    риск развития некоторых
                                    заболеваний. В целом, вы потребляете меньше калорий, чем вам требуется для вашей
                                    цели.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section params lifestyle">
                <div class="section__linear">
                    <div class="_container">
                        <h2>Образ жизни и состояние здоровья</h2>
                    </div>
                </div>
                <div class="section__container _container">
                    <div class="section__body">
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
                    </div>
                </div>
            </section>

            <?php if ($diary) : ?>
                <section class="section nutrition">
                    <div class="section__linear">
                        <div class="_container">
                            <h2>Оценка фактического питания</h2>
                        </div>
                    </div>
                    <div class="section__container _container">
                        <div class="section__body">
                            <?php if ($diary['diet_restrictions']) : ?>
                                <div class="nutrition-title">
                                    <span>Тип питания:</span>
                                    <?php foreach ($diary['diet_restrictions'] as $item) : ?>
                                        <span><?php echo $item ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="grid">
                                <?php if ($diary['waterDeviationFromNorm']) : ?>
                                    <div class="params-item fluid-amount">
                                        <div class="params-item__flex">
                                            <div class="params-item__left">
                                                <div class="icon">
                                                    <svg width="22" height="26" viewBox="0 0 22 26">
                                                        <use xlink:href='assets/img/svg/icons.svg#glass' />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="params-item__right">
                                                <label>Количество потребляемой жидкости</label>
                                            </div>
                                        </div>
                                        <div class="params-item__text">
                                            <div class="results-compare">
                                                <span class="results-norm">
                                                    <span></span>
                                                    <span>Норма</span>
                                                </span>
                                                <span class="results-patient">
                                                    <span></span>
                                                    <span>Ваш показатель</span>
                                                </span>
                                            </div>
                                            <div class="result-item__scale">
                                                <?php
                                                $water_min = $diary['waterDeviationFromNorm']['minThreshold'];
                                                $water_max = $diary['waterDeviationFromNorm']['maxThreshold'];
                                                $water_current = $diary['waterDeviationFromNorm']['mass'];
                                                $water_norm = $diary['waterDeviationFromNorm']['norm'];
                                                $water_unit = $diary['waterDeviationFromNorm']['unit'];

                                                $water_status = '';
                                                if ($water_current > $water_norm) {
                                                    $water_status = 'red';
                                                }

                                                $water_percents = calc_to_percent($water_min, $water_max, $water_current, $water_norm);
                                                ?>
                                                <div style="--norma:<?php echo $water_percents['norma'] ?>; --patient:<?php echo $water_percents['patient'] ?>" class="<?php echo $water_status ?>"></div>
                                                <p class="fluid-amount__result">
                                                    <span class="fluid-amount__patient <?php echo $water_status ?>">
                                                        Выпито <?php echo format_num(($water_current / 1000)) ?> л</span>
                                                    <span class="fluid-amount__norma">Цель <?php echo format_num(($water_norm / 1000)) ?> л</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($diary['calorieDistributionOfMeals']) : ?>
                                    <div class="params-item calorie-distribution">
                                        <div class="params-item__flex">
                                            <div class="params-item__left">
                                                <div class="icon">
                                                    <svg width="22" height="26" viewBox="0 0 22 26">
                                                        <use xlink:href='assets/img/svg/icons.svg#cutlery' />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="params-item__right">
                                                <label>Распределение калорийности приёмов пищи</label>
                                            </div>
                                        </div>
                                        <div class="params-item__text">
                                            <div class="calorie-distribution__flex">
                                                <?php foreach ($diary['calorieDistributionOfMeals'] as $item) : ?>
                                                    <div style="width: <?php echo $item['percent'] ?>%;">
                                                        <time><?php echo $item['time'] ?></time>
                                                        <span><?php echo $item['ingestion'] ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="nutrition-info text-accent italic">
                                Рацион человека состоит из нескольких десятков важнейших для здоровья веществ: витамины,
                                минералы,
                                белки и др. Очень
                                важно, чтобы их содержание было в норме. То есть соответствовало потребностям вашего
                                организма. Если
                                в вашем меню
                                количество каких-либо из этих веществ длительно находится в избытке (поступает слишком
                                много) или в
                                дефиците (поступает
                                слишком мало), то это может привести к различным заболеваниям.
                                Анализ вашего прошлого рациона показал, что: 52% важнейших веществ поступает в ваш организм
                                в
                                оптимальном количестве. В
                                то же время 43% полезных веществ вы недополучаете. А 5% — поступают в организм в чрезмерно
                                большом
                                количестве.
                            </div>
                            <?php
                            $nutr_graphic  = $diary['nutrientsInfo']['meta'];
                            if ($nutr_graphic) :
                            ?>
                                <div class="nutrition-graphic">
                                    <h3>Из всех важнейших веществ в вашем рационе:</h3>
                                    <div class="nutrition-graphic__flex">
                                        <div class="nutrition-graphic__item nomra chart" data-percent="<?php echo $nutr_graphic['normal'] ?>" data-color="#1dbdf5">
                                            <canvas></canvas>
                                            <span class="percent"><?php echo $nutr_graphic['normal'] ?> %</span>
                                            <span class="status">в норме</span>
                                        </div>
                                        <div class="nutrition-graphic__item deficit chart" data-percent="<?php echo $nutr_graphic['deficit'] ?>" data-color="#d26256">
                                            <canvas></canvas>
                                            <span class="percent"><?php echo $nutr_graphic['deficit'] ?>%</span>
                                            <span class="status">в дефиците</span>
                                        </div>
                                        <div class="nutrition-graphic__item excess chart" data-percent="<?php echo $nutr_graphic['excess'] ?>" data-color="#1dbdf5">
                                            <canvas></canvas>
                                            <span class="percent"><?php echo $nutr_graphic['excess'] ?>%</span>
                                            <span class="status">в избытке</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>


                <?php
                $nutrients = $diary['nutrientsInfo']['nutrients'];
                if ($nutrients) :
                ?>
                    <section class="section nutrition-table">
                        <div class="section__container _container">
                            <div class="section__body">
                                <div class="text-accent italic">
                                    <p>На этой странице показана пищевая ценность вашего прошлого рациона. Иными словами —
                                        <b>содержание</b> полезных и
                                        некоторых вредных для здоровья веществ. Голубой цвет — оптимальное количество. Красный —
                                        недостаточное или слишком
                                        избыточное количество вещества, что может негативно влиять на ваше здоровье или состав
                                        тела.
                                        Значения рассчитаны в
                                        среднем за один день.
                                    </p>
                                </div>
                                <div class="nutrition-table__item">
                                    <span>
                                        <span>Показатель</span>
                                        <span>% от вашей нормы</span>
                                    </span>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Калорийность</th>
                                                <th>1 г</th>
                                                <th>48%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $nutrients_caloreis = [
                                                $nutrients['protein'],
                                                $nutrients['fats'],
                                                $nutrients['carbohydrate']
                                            ];
                                            foreach ($nutrients_caloreis as $nutrient) :
                                                $i = 0;
                                                foreach ($nutrient as $item) :
                                                    if ($i == 0) {
                                                        $class = 'parent';
                                                    } else {
                                                        if ($item['mass'] > $item['norm']) {
                                                            $class = 'red';
                                                        } else {
                                                            $class = 'blue';
                                                        }
                                                    }
                                            ?>
                                                    <tr class="<?php echo $class ?>">
                                                        <?php if ($i == 0) : ?>
                                                            <td><b><?php echo $item['title'] ?></b></td>
                                                        <?php else : ?>
                                                            <td><?php echo $item['title'] ?></td>
                                                        <?php endif; ?>
                                                        <td style="--width:<?php echo $item['percent'] ?>%">1 <?php echo $item['unit'] ?></td>
                                                        <td><?php echo $item['percent'] ?>%</td>
                                                    </tr>

                                            <?php $i++;
                                                endforeach;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php
                                $nutrients_array = [
                                    'Прочее' => $nutrients['other'],
                                    'Витамины' => $nutrients['vitamins'],
                                    'Минаралы' => $nutrients['minerals']
                                ];
                                if ($nutrients_array) :
                                    foreach ($nutrients_array as $key => $nutrient) :
                                ?>
                                        <div class="nutrition-table__item">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $key ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($nutrient as $item) :
                                                        if ($i == 0) {
                                                            $class = 'parent';
                                                        } else {
                                                            if ($item['mass'] > $item['norm']) {
                                                                $class = 'red';
                                                            } else {
                                                                $class = 'blue';
                                                            }
                                                        }
                                                    ?>
                                                        <tr class="<?php echo $class ?>">
                                                            <?php if ($i == 0) : ?>
                                                                <td><b><?php echo $item['title'] ?></b></td>
                                                            <?php else : ?>
                                                                <td><?php echo $item['title'] ?></td>
                                                            <?php endif; ?>
                                                            <td style="--width:<?php echo $item['percent'] ?>%">1 <?php echo $item['unit'] ?></td>
                                                            <td><?php echo $item['percent'] ?>%</td>
                                                        </tr>

                                                    <?php $i++;
                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                <?php endforeach;
                                endif;  ?>

                            </div>
                        </div>
                    </section>
                <?php endif; ?>


                <section class="section nutrition-diagram">
                    <div class="section__container _container">
                        <div class="section__body">
                            <div class="text-accent italic">
                                <p>Ниже вам представлены наглядные диаграммы. Они показывают соотношение в вашем прошлом
                                    рационе
                                    важнейших для здоровья
                                    веществ. Определённые соотношения тех или иных веществ влияют на здоровье по-разному —
                                    улучшая
                                    или ухудшая его. Для
                                    подробных разъяснений обратитесь к специалисту</p>
                            </div>
                            <div class="grid grid-2">
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

                            </div>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        </main>

    </div>

    <script src="assets/files/chart.umd.min.js?_v=20240507194916"></script>
    <script src="assets/files/chartjs-annotation.min.js?_v=20240507194916"></script>
    <script src="assets/js/app.min.js?_v=20240507194916"></script>


</body>

</html>
<?php
pre($json_data);
?>