<?
    $zone = object('com:police.model.zone')->id($site)->getRow();
    $singleColumn = $extension == 'police' OR $extension == 'files' ? 'true' : 'false';

    $pages = object('com:pages.model.pages')->menu('1')->published('true')->getRowset()
?>

<div id="wrap">
    <div class="container container__header">
        <div class="header">
            <div class="organization" itemscope itemtype="http://schema.org/Organization">
                <a itemprop="url" href="/<?= $site ?>">
                    <div class="organization__logo organization__logo--<?= $language_short; ?>"></div>
                    <div class="organization__name"><span><?= translate('Police') ?></span> <?= escape($zone->title); ?></div>
                    <meta itemprop="logo" content="assets://application/images/logo-<?= array_shift(str_split($language, 2)); ?>.png" />
                </a>
                <button id="hamburger" class="button--hamburger" aria-hidden="true" aria-pressed="false" aria-controls="navigation" onclick="apollo.toggleClass(document.getElementById('navigation'), 'is-shown');apollo.toggleClass(document.getElementById('hamburger'), 'close');hamburger()">MENU <span class="lines"></span></button>
            </div>

            <div class="navigation">
                <span class="slogan">
                    <?= JText::sprintf('Call for urgent police assistance', '101') ?>.
                    <?= JText::sprintf('No emergency, just police', escape($zone->phone_information)) ?>.
                </span>
                <div id="navigation" class="navbar">
                    <ktml:modules position="navigation">
                        <ktml:modules:content>
                    </ktml:modules>
                </div>
            </div>
        </div>
    </div>

    <div class="container container__banner">
        <div class="banner__image banner__image--<?= $site ?>">

        </div>
    </div>

    <ktml:modules position="breadcrumbs">
        <div class="container container__breadcrumb">
            <ktml:modules:content>
        </div>
    </ktml:modules>

    <div class="container container__content<?= $extension == 'police' ? ' homepage' : '' ?>">
        <ktml:modules position="left">
            <aside class="sidebar">
                <ktml:modules:content>
            </aside>
        </ktml:modules>

        <? if(!$singleColumn) : ?>
        <div class="component">
        <? endif ?>
            <ktml:content>
        <? if(!$singleColumn) : ?>
        </div>
        <? endif ?>
    </div>

    <ktml:modules position="quicklinks">
    <div class="container container__footer">
        <div class="container__quicklinks">
            <ktml:modules:content>
        </div>
    </div>
    </ktml:modules>

    <? if($extension !== 'police') : ?>
    <div class="container container__footer">
        <div class="row">
            <div class="footer__news">
                <h3><?= translate('Latest news') ?></h3>
                <?= import('com:news.view.articles.list.html', array('articles' =>  object('com:news.model.articles')->sort('ordering_date')->direction('DESC')->published(true)->limit('2')->getRowset())) ?>
            </div>
            <? if($site !== '5888') : ?>
            <div class="footer__districts">
                <h3><?= translate('Your district officer') ?></h3>
                <p><?= translate('You know the responsible district officer in your area? He or she is your first contact with the police.') ?></p>
                <a href="/<?= $site ?>/contact/<?= object('lib:filter.slug')->sanitize(translate('Your district officer')) ?>"><?= translate('Contact your district officer') ?>.</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="container container__footer_menu">
        <ul class="nav nav--list">
            <li><a href="/<?= $site ?>"><?= translate('Home') ?></a></li>
            <? foreach($pages as $page) : ?>
            <? if($page->level == '1' && $page->hidden == false) : ?>
                <li><a href="/<?= $site ?>/<?= $page->slug ?>"><?= $page->title ?></a></li>
            <? endif ?>
            <? endforeach ?>
        </ul>
    </div>
</div>

<div id="copyright">
    <div class="container container__copyright">
        <div class="copyright--left">
            <? if($zone->twitter) : ?>
                <a href="http://www.twitter.com/<?= $zone->twitter ?>"><i class="icon-twitter"></i> Twitter</a>
            <? endif ?>
            <?= $zone->twitter && $zone->facebook ? '&nbsp;|&nbsp;' : '' ?>
            <? if($zone->facebook) : ?>
                <a href="http://www.facebook.com/<?= $zone->facebook ?>"><i class="icon-facebook"></i> Facebook</a>
            <? endif ?>
            <? foreach($pages as $page) : ?>
                <? if($page->id == '89' || $page->id == '101') : ?>
                    &nbsp;|&nbsp;&nbsp;<a href="/<?= $site ?>/<?= $page->slug ?>"><?= $page->title ?></a>
                <? endif ?>
            <? endforeach ?>
        </div>
        <div class="copyright--right">
            © <?= date(array('format' => 'Y')) ?> <?= translate('Local Police') ?> - <?= escape($zone->title); ?>
            <a style="margin-left: 10px" target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/disclaimer.html">Disclaimer</a> -
            <a target="_blank" href="http://www.lokalepolitie.be/portal/<?= $language_short ?>/privacy.html">Privacy</a> -
            <a href="http://www.belgium.be">Belgium.be</a>
        </div>
    </div>
</div>