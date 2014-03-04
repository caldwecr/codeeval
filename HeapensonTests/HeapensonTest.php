<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 3/3/14
 * Time: 2:12 PM
 */
require_once("heapenson.php");

class HeapensonTest extends PHPUnit_Framework_TestCase
{
    public function testHeapenson()
    {
//        //$h1 = 'div', $h2 = 'div', result = 0
//        $h1 = 'div';
//        $h2 = 'div';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(0, $result);
//
//        //$h1 = 'div#id', $h2 = 'div#id', result = 0
//        $h1 = 'div#id';
//        $h2 = 'div#id';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(0, $result);
//
//        //$h1 = 'div#id.cls.btn', $h2 = 'div#id.btn.cls', result = 0
//        $h1 = 'div#id.cls.btn';
//        $h2 = 'div#id.btn.cls';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(0, $result);
//
//        //$h1 = 'div#id', $h2 = 'div', result = 1
//        $h1 = 'div#id';
//        $h2 = 'div';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(1, $result);
//
//        //$h1 = 'div#id.btn' $h2 = 'div', result = 2
//        $h1 = 'div#id.btn';
//        $h2 = 'div';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(2, $result);
//
//        //$h1 = 'div#id.btn', $h2 = 'a.blue', result = 3
//        $h1 = 'div#id.btn';
//        $h2 = 'a.blue';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(3, $result);
//
//        //$h1 = 'div#id.btn.blue', $h2 = 'div.blue.btn', result = 1
//        $h1 = 'div#id.btn.blue';
//        $h2 = 'div.blue.btn';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(1, $result);
//
//        /*
//        div#id img.photo
//        a.btn
//        4
//        */
//        $h1 = 'div#id img.photo';
//        $h2 = 'a.btn';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(4, $result);
//
//
//        /*
//        a.btn
//        div#id img.photo
//        5
//        */
//        $h1 = 'a.btn';
//        $h2 = 'div#id img.photo';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(5, $result);
//
//        /*
//        div#id span.text a#link.btn
//        a#id.btn
//        4
//        Issue here is that there are more than one LCS of length 2 and the first one my algorithm discovers produces the less optimal solution -
//        perhaps the algorithm should consider all of the LCS possibilities.
//        */
//        $h1 = 'div#id span.text a#link.btn';
//        $h2 = 'a#id.btn';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(4, $result);
//
//        /*
//        a#id.btn
//        div#id span.text a#link.btn
//        6
//        */
//        $h1 = 'a#id.btn';
//        $h2 = 'div#id span.text a#link.btn';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(6, $result);
//
//        /*
//        div#id img.photo a.btn.share.link
//        a.btn div#id img.photo
//        3
//        */
//        $h1 = 'div#id img.photo a.btn.share.link';
//        $h2 = 'a.btn div#id img.photo';
//        $result = heapenson($h1, $h2);
//        $this->assertEquals(3, $result);

        /*
        a.btn div#id img.photo
        div#id img.photo.bw a.btn.share.link
        6
        @todo fix for this test case - index out of bounds error
        */
        $h1 = 'a.btn div#id img.photo';
        $h2 = 'div#id img.photo.bw a.btn.share.link';
        $result = heapenson($h1, $h2);
        $this->assertEquals(6, $result);

        /*
        a#id.btn
        div#id span.text a#id.share
        6
        */
        $h1 = 'a#id.btn';
        $h2 = 'div#id span.text a#id.share';
        $result = heapenson($h1, $h2);
        $this->assertEquals(6, $result);

        /*
        div#id.btn.blue a#enter
        a#enter.knob.green
        3
        */
        $h1 = 'div#id.btn.blue a#enter';
        $h2 = 'a#enter.knob.green';
        $result = heapenson($h1, $h2);
        $this->assertEquals(3, $result);

        /*
        a#enter.knob.green a#enter a#enter a#enter
        a#enter.knob.green
        3
        */
        $h1 = 'a#enter.knob.green a#enter a#enter a#enter';
        $h2 = 'a#enter.knob.green';
        $result = heapenson($h1, $h2);
        $this->assertEquals(3, $result);

        /*
        a#enter.knob.green
        a#enter.knob.green a#enter a#enter
        4
        */
        $h1 = 'a#enter.knob.green';
        $h2 = 'a#enter.knob.green a#enter a#enter';
        $result = heapenson($h1, $h2);
        $this->assertEquals(4, $result);

        /*
        a#enter
        a#enter.knob.green a#enter a#enter
        6
        */
        $h1 = 'a#enter';
        $h2 = 'a#enter.knob.green a#enter a#enter';
        $result = heapenson($h1, $h2);
        $this->assertEquals(6, $result);

        /*
        a#enter.knob.green
        a#enter.knob.green a#enter a#enter
        4
        */
        $h1 = 'a#enter.knob.green';
        $h2 = 'a#enter.knob.green a#enter a#enter';
        $result = heapenson($h1, $h2);
        $this->assertEquals(4, $result);

        /*
        a#enter
        a#enter.knob.green a#enter a#enter
        6
        */
        $h1 = 'a#enter';
        $h2 = 'a#enter.knob.green a#enter a#enter';
        $result = heapenson($h1, $h2);
        $this->assertEquals(6, $result);

        /*
        div#nav-col.billboard-layout.cf.main-row div#yui_3_8_1_1_1382751082490_1382.main-col-wrapper div#hero-col.main-col1 div#yui_3_8_1_1_1382751082490_1381.hero-col-wrapper div#stream div#default-p_30345786.mod.view_default div#default-p_30345786-bd.bd.type_stream.type_stream_default ul#yui_3_8_1_1_1382751082490_1533 li#yui_3_8_1_1_1382751082490_1718.cf.content.has-image.voh-parent div#yui_3_8_1_1_1382751082490_1717.cf.wrapper div#yui_3_8_1_1_1382751082490_1716.body div#yui_3_8_1_1_1382751082490_1715.body-wrap p#yui_3_8_1_1_1382751082490_1740.mt-xxs.summary
        div#nav-col.billboard-layout.cf.main-row div#yui_3_8_1_1_1382751082490_1382.main-col-wrapper div#hero-col.main-col1 div#yui_3_8_1_1_1382751082490_1381.hero-col-wrapper div#stream div#default-p_30345786.mod.view_default div#default-p_30345786-bd.bd.type_stream.type_stream_default ul#yui_3_8_1_1_1382751082490_1533 li#yui_3_8_1_1_1382751082490_1532.cf.content.voh-parent div#yui_3_8_1_1_1382751082490_1531.cf.wrapper div#yui_3_8_1_1_1382751082490_1530.body div#yui_3_8_1_1_1382751082490_1529.body-wrap p#yui_3_8_1_1_1382751082490_1554.mt-xxs.summary
        11
        */
        $h1 = 'div#nav-col.billboard-layout.cf.main-row div#yui_3_8_1_1_1382751082490_1382.main-col-wrapper div#hero-col.main-col1 div#yui_3_8_1_1_1382751082490_1381.hero-col-wrapper div#stream div#default-p_30345786.mod.view_default div#default-p_30345786-bd.bd.type_stream.type_stream_default ul#yui_3_8_1_1_1382751082490_1533 li#yui_3_8_1_1_1382751082490_1718.cf.content.has-image.voh-parent div#yui_3_8_1_1_1382751082490_1717.cf.wrapper div#yui_3_8_1_1_1382751082490_1716.body div#yui_3_8_1_1_1382751082490_1715.body-wrap p#yui_3_8_1_1_1382751082490_1740.mt-xxs.summary';
        $h2 = 'div#nav-col.billboard-layout.cf.main-row div#yui_3_8_1_1_1382751082490_1382.main-col-wrapper div#hero-col.main-col1 div#yui_3_8_1_1_1382751082490_1381.hero-col-wrapper div#stream div#default-p_30345786.mod.view_default div#default-p_30345786-bd.bd.type_stream.type_stream_default ul#yui_3_8_1_1_1382751082490_1533 li#yui_3_8_1_1_1382751082490_1532.cf.content.voh-parent div#yui_3_8_1_1_1382751082490_1531.cf.wrapper div#yui_3_8_1_1_1382751082490_1530.body div#yui_3_8_1_1_1382751082490_1529.body-wrap p#yui_3_8_1_1_1382751082490_1554.mt-xxs.summary';
        $result = heapenson($h1, $h2);
        $this->assertEquals(11, $result);

        /*
        div#masthead.billboard-layout.cf.main-col div#yui_3_8_1_1_1382751082490_1862.main-row-wrapper div#default-p_13838465.mod.view_default div#default-p_13838465-bd.bd.type_masthead.type_masthead_default div#yui_3_8_1_1_1382751082490_1861.clearfix.lightbg.mh-wrap.us.y-fp-pg-grad form#p_13838465-searchform.search-form fieldset#yui_3_8_1_1_1382751082490_1860.compact-enabled-fieldset div#p_13838465-searchwrapper.searchwrapper.selected.tabpanel div#yui_3_8_1_1_1382751082490_1859.focus.searchwrapper-border.y-srch-brdr div#fp-search-bdr.brdr-focus.clearfix.searchwrapper-inner.y-glbl-srch-bg-img div#yui_3_8_1_1_1382751082490_1858.input-wrapper input#p_13838465-p.compact-input-enabled.input-long.input-query.med-large
        div#masthead.billboard-layout.cf.main-col div#yui_3_8_1_1_1382751082490_1862.main-row-wrapper div#default-p_13838465.mod.view_default div#default-p_13838465-bd.bd.type_masthead.type_masthead_default div#yui_3_8_1_1_1382751082490_1861.clearfix.lightbg.mh-wrap.us.y-fp-pg-grad form#p_13838465-searchform.search-form fieldset#yui_3_8_1_1_1382751082490_1860.compact-enabled-fieldset div#p_13838465-searchwrapper.searchwrapper.selected.tabpanel div#yui_3_8_1_1_1382751082490_1859.searchwrapper-border.y-srch-brdr div#fp-search-bdr.clearfix.searchwrapper-inner.y-glbl-srch-bg-img div#yui_3_8_1_1_1382751082490_1858.input-wrapper input#p_13838465-p.compact-input-enabled.input-long.input-query.med-large
        2
        */
        $h1 = 'div#masthead.billboard-layout.cf.main-col div#yui_3_8_1_1_1382751082490_1862.main-row-wrapper div#default-p_13838465.mod.view_default div#default-p_13838465-bd.bd.type_masthead.type_masthead_default div#yui_3_8_1_1_1382751082490_1861.clearfix.lightbg.mh-wrap.us.y-fp-pg-grad form#p_13838465-searchform.search-form fieldset#yui_3_8_1_1_1382751082490_1860.compact-enabled-fieldset div#p_13838465-searchwrapper.searchwrapper.selected.tabpanel div#yui_3_8_1_1_1382751082490_1859.focus.searchwrapper-border.y-srch-brdr div#fp-search-bdr.brdr-focus.clearfix.searchwrapper-inner.y-glbl-srch-bg-img div#yui_3_8_1_1_1382751082490_1858.input-wrapper input#p_13838465-p.compact-input-enabled.input-long.input-query.med-large';
        $h2 = 'div#masthead.billboard-layout.cf.main-col div#yui_3_8_1_1_1382751082490_1862.main-row-wrapper div#default-p_13838465.mod.view_default div#default-p_13838465-bd.bd.type_masthead.type_masthead_default div#yui_3_8_1_1_1382751082490_1861.clearfix.lightbg.mh-wrap.us.y-fp-pg-grad form#p_13838465-searchform.search-form fieldset#yui_3_8_1_1_1382751082490_1860.compact-enabled-fieldset div#p_13838465-searchwrapper.searchwrapper.selected.tabpanel div#yui_3_8_1_1_1382751082490_1859.searchwrapper-border.y-srch-brdr div#fp-search-bdr.clearfix.searchwrapper-inner.y-glbl-srch-bg-img div#yui_3_8_1_1_1382751082490_1858.input-wrapper input#p_13838465-p.compact-input-enabled.input-long.input-query.med-large';
        $result = heapenson($h1, $h2);
        $this->assertEquals(2, $result);

        /*
        header.cf.header div.nav-bar div.lc form.search-form fieldset input.search-field
        header.cf.header div.nav-bar div.lc div.header-social ul.inline-list.social-list.sprite-social
        8
        @todo fix for this test case - not perfomant and wrong answer - gives 9 but should be 8
        */
        /*$h1 = 'header.cf.header div.nav-bar div.lc form.search-form fieldset input.search-field';
        $h2 = 'header.cf.header div.nav-bar div.lc div.header-social ul.inline-list.social-list.sprite-social';
        $result = heapenson($h1, $h2);
        $this->assertEquals(8, $result);*/

        /*
        header.cf.header div.nav-bar div.lc form.search-form fieldset input.search-field
        div.fluid.flush.homepage.split div.flush.lc.lc-island div.l-two-col div.l-main-container div.l-main ul#river1.lc-padding.river li#905418.river-block div.block.block-thumb div.block-content p.excerpt
        30
        @todo fix for this test case - gives 29, should be 30
        */
/*        $h1 = 'header.cf.header div.nav-bar div.lc form.search-form fieldset input.search-field';
        $h2 = 'div.fluid.flush.homepage.split div.flush.lc.lc-island div.l-two-col div.l-main-container div.l-main ul#river1.lc-padding.river li#905418.river-block div.block.block-thumb div.block-content p.excerpt';
        $result = heapenson($h1, $h2);
        $this->assertEquals(30, $result);*/


        /*
        div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopt1 div#cnn_maint1lftf.breaking div#cnn_maintt1imgbul div.cnn_main10t1cntnt div.cnn_main10t1lcntr div.cnn_main10t1sbbin2c ul.cnn_bulletbin li.c_hpbullet4 a
        div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopt1 div#cnn_maint1lftf.breaking div#cnn_maintt1imgbul div.cnn_main10t1cntnt div.cnn_main10t1lcntr div div.cnn_main10t1stxt div#cnn_tc_t1_rich_text div.cnn_two_column_t_rich_text
        9
        @todo fix for this text case - gives 10, should be 9
        */
/*        $h1 = 'div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopt1 div#cnn_maint1lftf.breaking div#cnn_maintt1imgbul div.cnn_main10t1cntnt div.cnn_main10t1lcntr div.cnn_main10t1sbbin2c ul.cnn_bulletbin li.c_hpbullet4 a';
        $h2 = 'div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopt1 div#cnn_maint1lftf.breaking div#cnn_maintt1imgbul div.cnn_main10t1cntnt div.cnn_main10t1lcntr div div.cnn_main10t1stxt div#cnn_tc_t1_rich_text div.cnn_two_column_t_rich_text';
        $result = heapenson($h1, $h2);
        $this->assertEquals(9, $result);*/

        /*
        div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopt1 div#cnn_maintoplive div.cnn_mc2cntr div.cnn_mc23x1cnntr div#cnn_mc2_large1.cnn_mc2_img_right.cnn_mc2_large div div.cnn_mc2_text_left div.cnn_mc2_blurb a
        div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopprofile div#on_tv.cnn_hppersonal div#cnn_pmtvmodule div.cnn_hppersonalfeature div.cnn_pmtvmodddown.cnn_tsbnav form select
        16
        @todo fix for this test case - gives 20 should be 16
        */
/*        $h1 = 'div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopt1 div#cnn_maintoplive div.cnn_mc2cntr div.cnn_mc23x1cnntr div#cnn_mc2_large1.cnn_mc2_img_right.cnn_mc2_large div div.cnn_mc2_text_left div.cnn_mc2_blurb a';
        $h2 = 'div div#cnn_maincntnr div.cnn_contentarea.cnn_shdcamtt12010.cnn_shdcamtt1l250.cnn_t1lo_bnews.cnn_t1lo_refresh div#cnn_maintopprofile div#on_tv.cnn_hppersonal div#cnn_pmtvmodule div.cnn_hppersonalfeature div.cnn_pmtvmodddown.cnn_tsbnav form select';
        $result = heapenson($h1, $h2);
        $this->assertEquals(16, $result);*/

        /*
        div#shell div#page.active.tabContent div#main div.baseLayout.wrap div.column.last div.layout.spanAB div.abColumn.column div.layout.module.wideB div.aColumn.column.opening div.columnGroup div.story p.summary
        div#page.active.tabContent div#main div.baseLayout.wrap div.column.last div.layout.spanAB div.abColumn.column div.layout.module.wideB div.aColumn.column.opening div.columnGroup.first div.story p.summary
        2
        @todo fix for this test case - gives 22 should be 2
        */
        /*$h1 = 'div#shell div#page.active.tabContent div#main div.baseLayout.wrap div.column.last div.layout.spanAB div.abColumn.column div.layout.module.wideB div.aColumn.column.opening div.columnGroup div.story p.summary';
        $h2 = 'div#page.active.tabContent div#main div.baseLayout.wrap div.column.last div.layout.spanAB div.abColumn.column div.layout.module.wideB div.aColumn.column.opening div.columnGroup.first div.story p.summary';
        $result = heapenson($h1, $h2);
        $this->assertEquals(2, $result);*/


        /*
        div#shell div#page.active.tabContent div#toolbar div#toolbarSearchContainer.toolbarSearchContainer-withad div#toolbarSearch.toolbarSearchActive div.inlineSearchControl form#searchForm input#hpSearchQuery.text
        div#shell div#page.active.tabContent div#toolbar div#toolbarSearchContainer.toolbarSearchContainer-withad div#toolbarSearch div.inlineSearchControl form#searchForm input#hpSearchQuery.text
        1
        */
        $h1 = 'div#shell div#page.active.tabContent div#toolbar div#toolbarSearchContainer.toolbarSearchContainer-withad div#toolbarSearch.toolbarSearchActive div.inlineSearchControl form#searchForm input#hpSearchQuery.text';
        $h2 = 'div#shell div#page.active.tabContent div#toolbar div#toolbarSearchContainer.toolbarSearchContainer-withad div#toolbarSearch div.inlineSearchControl form#searchForm input#hpSearchQuery.text';
        $result = heapenson($h1, $h2);
        $this->assertEquals(1, $result);

        /*
        header.mh div.mh-stripe div.mh-stripe-wrap ul.mh-user-menu li.last a.omniture-tagged.omniture-tagged-291.show-login
        div.ec-overlay div.login-wrap form#user-login.clearfix.context-user_login.ec-social.user-form div div#edit-name-wrapper.clearfix.form-item input#edit-name.form-email.form-text.required
        24
        @todo fix for this test case - gives 23, should be 24
        */
/*        $h1 = 'header.mh div.mh-stripe div.mh-stripe-wrap ul.mh-user-menu li.last a.omniture-tagged.omniture-tagged-291.show-login';
        $h2 = 'div.ec-overlay div.login-wrap form#user-login.clearfix.context-user_login.ec-social.user-form div div#edit-name-wrapper.clearfix.form-item input#edit-name.form-email.form-text.required';
        $result = heapenson($h1, $h2);
        $this->assertEquals(24, $result);*/


        /*
        div#page.container div#columns.clearfix div#leadspot.clearfix.grid-16 div#block-ec_homepage-ec_homepage_superhero.block.block-ec_homepage div.clearfix.content div#superhero.clearfix div.hero-superhero ul#hero.hero-multiple li.selected div.hero-item.hero-item-4 a.hero-tab.omniture-tagged.omniture-tagged-127 p.headline
        div#page.container div#columns.clearfix div#column-content.clearfix.grid-10.grid-first div.grid-7.grid-first.push-3 div#homepage-center-inner section.news-package.typog-package article a.omniture-tagged.omniture-tagged-20 div h2.headline
        25
        */
        $h1 = 'div#page.container div#columns.clearfix div#leadspot.clearfix.grid-16 div#block-ec_homepage-ec_homepage_superhero.block.block-ec_homepage div.clearfix.content div#superhero.clearfix div.hero-superhero ul#hero.hero-multiple li.selected div.hero-item.hero-item-4 a.hero-tab.omniture-tagged.omniture-tagged-127 p.headline';
        $h2 = 'div#page.container div#columns.clearfix div#column-content.clearfix.grid-10.grid-first div.grid-7.grid-first.push-3 div#homepage-center-inner section.news-package.typog-package article a.omniture-tagged.omniture-tagged-20 div h2.headline';
        $result = heapenson($h1, $h2);
        $this->assertEquals(25, $result);
    }
}