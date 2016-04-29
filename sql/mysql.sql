CREATE TABLE `yaoh_light` (
  `light_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '跑馬燈編號',
  `font_color` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `font_family` varchar(50) DEFAULT NULL,
  `scrollDelay` int(11) DEFAULT NULL,
  `direction` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `light_behavior` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `scrollAmount` int(11) DEFAULT NULL,
  `LOOP` int(11) DEFAULT NULL,
  `shadow_color` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `shadow_h` int(11) DEFAULT '2',
  `shadow_v` int(11) DEFAULT '2',
  `shadow_b` int(11) DEFAULT '5',
  `rotate_deg` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fontsize` varchar(20) DEFAULT NULL,
  `fontsize_hover` varchar(20) DEFAULT NULL,
  `trans_time` varchar(20) DEFAULT NULL,
  `AltTitle` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `light_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `light_link` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tag` varchar(300) DEFAULT NULL,
  `is_show` tinyint(1) DEFAULT '1',
  `light_rank` int(11) DEFAULT '1',
  PRIMARY KEY (`light_id`)
) ENGINE=MyISAM;

INSERT INTO `yaoh_light` (`light_id`, `font_color`, `font_family`, `scrollDelay`, `direction`, `light_behavior`, `scrollAmount`, `LOOP`, `shadow_color`, `shadow_h`, `shadow_v`, `shadow_b`, `rotate_deg`, `fontsize`, `fontsize_hover`, `trans_time`, `AltTitle`, `light_content`, `light_link`, `tag`, `is_show`, `light_rank`) VALUES
(206, '#7c9cd8', 'DFKai-sb', 0, '', 'alternate', 1, 0, '#7064d9', -10, 5, 40, '0', '1em', '1em', NULL, '', '狂賀！本校榮獲101年度臺南市交通安全教育評鑑『<font color=red size=5>特優</font>』<img src=http://www2.dcjh.tn.edu.tw/gallery3/var/thumbs/yaoh/%E7%B4%A0%E6%9D%90%E5%BA%ABlib/run1.png?m=1356839301 >', '', '榮譽榜,首頁', 1, 0),
(69, '#28e8d5', NULL, 0, '', 'alternate', 3, 0, '#c5767d', 10, 10, 50, '0', '1', NULL, NULL, '', '狂賀!!!本校榮獲101年度教育部全國『<font color=red>閱讀磐石學校</font>』!!!', 'http://www.tyjh.kh.edu.tw/rock/download.php?dir=news&newsID=19&newsFile=2', '榮譽榜,首頁', 1, 0),
(209, '#5c31b7', NULL, 4, 'right', '', 2, 0, '#a3f764', 10, -3, 5, '0', '1', NULL, NULL, '', '賀!!!!本校參加臺南市直笛合奏比賽榮獲優等_______超厲害!!!!本校參加臺南市打擊樂合奏比賽榮獲優等第一名', 'http://www.tyjh.kh.edu.tw/rock/download.php?dir=news&newsID=19&newsFile=2', '榮譽榜', 1, 0),
(200, '#2e53e9', NULL, 0, 'right', 'alternate', 1, 0, '#d3d8e8', 10, 10, 5, '0', '1', NULL, NULL, '', '網路沉迷有三傷：傷身、傷神、傷感情', '', '宣導', 1, 0),
(210, '#aeeed7', 'PMingLiU', 500, 'right', 'alternate', 1, 0, '#50e2e2', 2, 2, 5, '0', '1em', '3em', NULL, '', '「<font color=red>易猜密碼不要用</font>」「<font color=green>個人資料不洩漏</font>」<br />\n「<font color=blue>電腦用畢要登出</font>」「<font color=brown>防毒軟體常更新</font>」<br />\n「不明郵件不要開」「不當網站不瀏覽」<br />\n「盜版軟體不可用」「智慧財產要尊重」', '', '宣導', 1, 0);