<div id="yRssTwitter" class="span-2 last">
    <div class="yRssTwitter-header">
        <div class="yRssTwitter-header-left" style="<?php echo $logoStyle; ?>">
            &nbsp;
        </div>
        <div class="yRssTwitter-header-right">
            <div class="yRssTwitterDisplayName"><?php echo $displayName ?></div>
            <a class="yRssTwitterUserName" href="http://twitter.com/#!/<?php echo $twitterUser ?>" target="_blank">
                <?php echo $twitterUser ?>
            </a>
        </div>
    </div>
<?php 
    foreach($rss as $key=>$entry) { ?>

    <div class="yRssTwitter-entry <?php echo ($key == count($rss)-1) ? 'yRssTwitter-entry-last' : '' ?>">
        <p>
            <?php echo $entry["description"]; ?>
        </p>
        <span class="yRssTwitter-span">
            <a target="_blank" href="<?php echo $entry['guid']; ?>"><?php echo $entry['date']; ?></a>
        </span>
        <span class="yRssTwitter-span yRssTwitter-span-separator"> · </span>
        <span class="yRssTwitter-span">
            <a target="_blank" href="<?php echo $entry['replyUrl']; ?>"><?php echo $twitterActions['reply']; ?></a>
        </span>
        <span class="yRssTwitter-span yRssTwitter-span-separator"> · </span>
        <span class="yRssTwitter-span">
            <a target="_blank" href="<?php echo $entry['retweetUrl']; ?>">retweet</a>
        </span>
        <span class="yRssTwitter-span yRssTwitter-span-separator"> · </span>
        <span class="yRssTwitter-span">
            <a target="_blank" href="<?php echo $entry['favoriteUrl']; ?>"><?php echo $twitterActions['favorite']; ?></a>
        </span>
    </div>
<?php } ?>
    <div class="yRssTwitter-footer">
        &nbsp;
    </div>
</div>
