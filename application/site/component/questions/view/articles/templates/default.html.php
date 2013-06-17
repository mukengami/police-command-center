<?
/**
* Belgian Police Web Platform - Questions Component
*
* @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
* @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
* @link		http://www.police.be
*/
?>

<div class="page-header">
    <h1><?php echo @escape($params->get('page_title')); ?></h1>
</div>

<?= @template('default_search.html') ?>

<? if(!$state->category AND !$state->searchword) : ?>
<?= @template('com:questions.view.categories.list.html', array('categories' => @object('com:questions.model.categories')->table('questions')->published(true)->sort('title')->getRowset())) ?>
<? endif ?>

<? if($state->category AND !$state->searchword) : ?>
<ul class="nav nav-pills nav-stacked">
<? foreach ($articles as $article) : ?>
    <li>
        <a href="<?= @helper('route.article', array('row' => $article)) ?>">
            <?= $article->title; ?>
        </a>
    </li>
<? endforeach; ?>
</ul>
<? endif ?>

<? if($state->searchword) : ?>
<? foreach ($articles as $article): ?>
    <div class="page-header">
        <h1>
            <a href="<?= @helper('route.article', array('row' => $article)) ?>">
                <?= @highlight($article->title) ?>
            </a>
        </h1>
    </div>

    <?= @highlight($article->text) ?>
<? endforeach ?>
<? endif ?>

<? if($state->category OR $state->searchword) : ?>
<?= @helper('com:application.paginator.pagination', array('total' => $total, 'show_count' => false, 'show_limit' => false)) ?>
<? endif ?>