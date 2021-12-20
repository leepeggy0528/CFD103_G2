SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `tibamefe_cdf103g2`
--
CREATE DATABASE IF NOT EXISTS `tibamefe_cdf103g2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tibamefe_cdf103g2`;

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(24) NOT NULL,
  `admin_pswd` varchar(24) NOT NULL,
  `admin_name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_pswd`, `admin_name`) VALUES
('111', 'abc123', 'CFD103_G2'),
('tibame', 'cfd103', 'tibame'),
('yangyang0429', '880429', 'YangYang');

-- --------------------------------------------------------

--
-- 資料表結構 `block`
--

CREATE TABLE `block` (
  `mem_id` int NOT NULL,
  `block_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `block`
--

INSERT INTO `block` (`mem_id`, `block_id`) VALUES
(9455009, 9455005),
(9455009, 9455007),
(9455009, 9455008),
(9455010, 9455009),
(9455009, 9455010);

-- --------------------------------------------------------

--
-- 資料表結構 `card_style`
--

CREATE TABLE `card_style` (
  `cstyle_no` int NOT NULL,
  `cstyle_name` varchar(20) NOT NULL,
  `cstyle_pt` varchar(20) NOT NULL,
  `cstyle_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:上架 1:下架'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `card_style`
--

INSERT INTO `card_style` (`cstyle_no`, `cstyle_name`, `cstyle_pt`, `cstyle_status`) VALUES
(67001, '彩虹邊框', 'rainbow.jpg', 0),
(67002, '七彩條紋', 'colorful-line.jpg', 0),
(67003, '滿版點點', 'dot.jpg', 1),
(67004, '手繪幾何', 'paint.jpg', 0),
(67005, '秋天的蠟筆塗鴉', 'crayon.jpg', 0),
(67006, '樹葉和水彩', 'leaf.jpg', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `friend`
--

CREATE TABLE `friend` (
  `mem_id` int NOT NULL,
  `friend_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `friend`
--

INSERT INTO `friend` (`mem_id`, `friend_id`) VALUES
(9455004, 9455001),
(9455005, 9455001),
(9455006, 9455001),
(9455007, 9455002),
(9455008, 9455002),
(9455009, 9455002),
(9455010, 9455002),
(9455005, 9455003),
(9455006, 9455003),
(9455001, 9455004),
(9455001, 9455005),
(9455003, 9455005),
(9455001, 9455006),
(9455003, 9455006),
(9455002, 9455007),
(9455002, 9455008),
(9455002, 9455009),
(9455002, 9455010);

-- --------------------------------------------------------

--
-- 資料表結構 `gro_mes`
--

CREATE TABLE `gro_mes` (
  `gmes_no` int NOT NULL,
  `gro_id` int NOT NULL,
  `mem_id` int NOT NULL,
  `gmes_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gmes_context` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `gro_mes`
--

INSERT INTO `gro_mes` (`gmes_no`, `gro_id`, `mem_id`, `gmes_time`, `gmes_context`) VALUES
(9488001, 9487006, 9455004, '2021-12-16 09:50:15', '這遊戲很好玩，我之前有玩過~~'),
(9488002, 9487004, 9455002, '2021-12-16 09:50:15', '這活動會不會超時阿');

-- --------------------------------------------------------

--
-- 資料表結構 `gro_pt`
--

CREATE TABLE `gro_pt` (
  `gpt_no` int NOT NULL,
  `gro_id` int NOT NULL,
  `gpt_pt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `gro_pt`
--

INSERT INTO `gro_pt` (`gpt_no`, `gro_id`, `gpt_pt`) VALUES
(9489001, 9487005, 'basketball01.jpg'),
(9489002, 9487005, 'basketball02.jpg'),
(9489003, 9487005, 'basketball03.jpg'),
(9489004, 9487002, 'flower01.jpg'),
(9489005, 9487002, 'flower02.jpg'),
(9489006, 9487001, 'hot01.jpg'),
(9489007, 9487001, 'hot02.jpg'),
(9489008, 9487004, 'library01.jpg'),
(9489009, 9487004, 'library02.jpg'),
(9489010, 9487007, 'market01.jpg'),
(9489011, 9487007, 'market02.jpg'),
(9489012, 9487003, 'night_market01.jpg'),
(9489013, 9487003, 'night_market02.jpg'),
(9489014, 9487003, 'night_market03.jpg'),
(9489015, 9487006, 'room_escape.jpg'),
(9489017, 9487008, 'nightclub.jpg'),
(9489018, 9487009, 'play_ground.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `gro_report`
--

CREATE TABLE `gro_report` (
  `greport_no` int NOT NULL,
  `gro_id` int NOT NULL,
  `greport_reason` varchar(60) NOT NULL,
  `greport_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `greport_status` tinyint NOT NULL DEFAULT '0' COMMENT '0:未處理 1:通過 2:不通過'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `gro_report`
--

INSERT INTO `gro_report` (`greport_no`, `gro_id`, `greport_reason`, `greport_time`, `greport_status`) VALUES
(9484001, 9487002, '我討厭這個團主', '2021-11-20 12:00:00', 0),
(9484002, 9487008, '活動說明和活動不符，色情', '2021-11-30 08:00:00', 0),
(9484003, 9487006, '討厭密逃，檢舉萬歲！', '2021-12-10 11:00:00', 0),
(9484004, 9487009, '團主亂開團', '2021-12-12 15:00:00', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `hashtag`
--

CREATE TABLE `hashtag` (
  `has_no` int NOT NULL,
  `has_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `has_times` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `hashtag`
--

INSERT INTO `hashtag` (`has_no`, `has_name`, `has_times`) VALUES
(7777001, '旅遊', 3),
(7777002, '美食', 3),
(7777003, '電影', 0),
(7777004, '唱歌', 0),
(7777005, '其他', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `host_rate`
--

CREATE TABLE `host_rate` (
  `mem_id` int NOT NULL,
  `gro_id` int NOT NULL,
  `host_id` int NOT NULL,
  `hrate_score` int NOT NULL,
  `hrate_context` varchar(40) DEFAULT NULL,
  `hrate_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `host_rate`
--

INSERT INTO `host_rate` (`mem_id`, `gro_id`, `host_id`, `hrate_score`, `hrate_context`, `hrate_time`) VALUES
(9455001, 9487005, 9455005, 3, '', '2021-12-19 22:00:00'),
(9455001, 9487007, 9455007, 4, '', '2021-11-27 23:00:00'),
(9455002, 9487003, 9455003, 5, '讚', '2021-11-29 21:00:00'),
(9455002, 9487005, 9455005, 2, '脾氣不好', '2021-12-20 08:40:00'),
(9455003, 9487005, 9455005, 4, '', '2021-12-20 08:40:00'),
(9455004, 9487003, 9455003, 5, '期待下次再約', '2021-11-29 21:00:00'),
(9455004, 9487005, 9455005, 5, '', '2021-12-20 08:40:00'),
(9455004, 9487007, 9455007, 4, '', '2021-11-27 23:00:00'),
(9455006, 9487003, 9455003, 3, '', '2021-11-29 21:01:00'),
(9455006, 9487005, 9455005, 4, '', '2021-12-20 08:40:00'),
(9455007, 9487003, 9455003, 3, '', '2021-11-29 21:02:00'),
(9455007, 9487005, 9455005, 4, '', '2021-12-20 08:40:00'),
(9455008, 9487005, 9455005, 3, '', '2021-12-20 08:40:00'),
(9455008, 9487007, 9455007, 4, '', '2021-11-27 23:01:00'),
(9455010, 9487003, 9455003, 5, 'Nice!!', '2021-11-29 21:03:00'),
(9455010, 9487005, 9455005, 5, '好人', '2021-12-20 08:40:00');

-- --------------------------------------------------------

--
-- 資料表結構 `igroup`
--

CREATE TABLE `igroup` (
  `gro_id` int NOT NULL,
  `mem_id` int NOT NULL,
  `gro_name` varchar(25) NOT NULL,
  `gro_startd` date NOT NULL,
  `gro_endd` date NOT NULL,
  `gro_endadd` date NOT NULL,
  `gro_paytype` tinyint NOT NULL COMMENT '0:免費 1:各付各 2:平分',
  `gro_pay` varchar(10) NOT NULL,
  `gro_type` varchar(10) NOT NULL,
  `gro_loc` varchar(10) NOT NULL,
  `gro_supnumber` int DEFAULT NULL,
  `gro_infnumber` int NOT NULL DEFAULT '1',
  `gro_number` int NOT NULL DEFAULT '0',
  `gro_explan` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gro_status` tinyint NOT NULL DEFAULT '2' COMMENT '0:失敗 1:成功 2:揪團中',
  `gro_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:隱藏 1:顯示',
  `auth` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:無 1:有'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `igroup`
--

INSERT INTO `igroup` (`gro_id`, `mem_id`, `gro_name`, `gro_startd`, `gro_endd`, `gro_endadd`, `gro_paytype`, `gro_pay`, `gro_type`, `gro_loc`, `gro_supnumber`, `gro_infnumber`, `gro_number`, `gro_explan`, `gro_status`, `gro_show`, `auth`) VALUES
(9487001, 9455001, '天冷吃火鍋', '2021-11-28', '2021-11-28', '2021-11-28', 2, '500', '美食', '桃園', 5, 1, 3, '天氣轉涼\n是時候該吃鍋暖暖身體了吧？\n\n預計會吃單鍋麻辣鍋\n希望參加者能夠吃小辣哦\n', 2, 1, 0),
(9487002, 9455002, '桃源仙草花節', '2021-11-26', '2021-11-26', '2021-11-25', 0, '0', '休閒', '桃園', 10, 1, 0, '預計開車前往，\n本人已打了兩劑疫苗\n大家可以放心出遊', 2, 0, 0),
(9487003, 9455003, '新豐夜市吃晚餐', '2021-11-29', '2021-11-29', '2021-11-29', 1, '300', '夜市', '新竹', 4, 1, 0, '新豐夜市很小，\n大約五分鐘就可逛完，\n可接受在報名。', 1, 1, 0),
(9487004, 9455004, '說書聚會', '2021-11-27', '2021-11-27', '2021-11-26', 1, '200', '學習', '新竹', 15, 1, 0, '每月固定的一場公開說書聚會\n不一定要事先閱讀\n也不是要參加者分享書籍\n邀請您一起來聽說書人的分享', 2, 1, 0),
(9487005, 9455005, '佔領陽明籃球場', '2021-12-19', '2021-12-19', '2021-12-18', 0, '0', '運動', '桃園', 0, 5, 2, '', 1, 1, 0),
(9487006, 9455006, '邏思起子密室逃脫', '2021-12-26', '2021-12-26', '2021-12-26', 1, '690', '燒腦', '台北', 6, 2, 3, '主題:獨眼傑克\n時間： 14:30\n遊戲人數：2-6人\n價格: 2人 690元/人  3人 600元/人\n         4-5人 550元/人  6人  500元/人\n遊戲時間：90分鐘（含遊戲60分鐘與講解30分鐘\n\n14:00先在門口集合，最晚14:15要到\n預計14:20一起入場', 2, 0, 0),
(9487007, 9455007, '好市多購物', '2021-11-27', '2021-11-27', '2021-11-27', 1, '0', '購物', '台中', 3, 1, 1, '好市多2樓入口集合\n進場之後可以分開逛也可一起逛\n預計30分鐘到1小時\n\n務必戴口罩才能入場\n我代刷，你給我現金或轉帳\n可以提早結帳\n發票歸你', 1, 1, 0),
(9487008, 9455009, '增廣見聞', '2021-12-02', '2021-12-02', '2021-12-01', 0, '0', '旅行', '台中', 1, 1, 0, '男女性皆可，18歲以上，認識更多的自然現象文明，增加自我的知識', 2, 0, 0),
(9487009, 9455010, '歡樂旅遊團', '2021-12-15', '2021-12-15', '2021-12-14', 0, '0', '購物', '台北', 7, 1, 0, '傻瓜笨蛋才會報名啦啦啦啦啦啦啦啦啦啦', 2, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `join_rate`
--

CREATE TABLE `join_rate` (
  `join_id` int NOT NULL,
  `gro_id` int NOT NULL,
  `host_id` int NOT NULL,
  `jrate_score` int NOT NULL,
  `jrate_context` varchar(40) DEFAULT NULL,
  `jrate_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `join_rate`
--

INSERT INTO `join_rate` (`join_id`, `gro_id`, `host_id`, `jrate_score`, `jrate_context`, `jrate_time`) VALUES
(9455001, 9487005, 9455005, 3, '', '2021-12-20 06:00:00'),
(9455001, 9487007, 9455007, 3, '一般般', '2021-11-27 22:00:00'),
(9455002, 9487003, 9455003, 4, '整體感覺佳~~', '2021-11-29 20:00:00'),
(9455002, 9487005, 9455005, 2, '體驗不佳', '2021-12-20 08:40:00'),
(9455003, 9487005, 9455005, 4, '', '2021-12-20 09:06:00'),
(9455004, 9487003, 9455003, 5, '讚!!', '2021-11-29 22:00:00'),
(9455004, 9487005, 9455005, 5, '', '2021-12-20 10:55:00'),
(9455004, 9487007, 9455007, 3, '', '2021-11-28 10:00:00'),
(9455006, 9487003, 9455003, 3, '', '2021-12-01 08:00:00'),
(9455006, 9487005, 9455005, 4, '', '2021-12-20 12:43:00'),
(9455007, 9487003, 9455003, 3, '', '2021-12-02 13:00:00'),
(9455007, 9487005, 9455005, 4, '', '2021-12-20 14:01:00'),
(9455008, 9487005, 9455005, 3, '有點小缺點，整體還可以', '2021-12-20 19:59:00'),
(9455008, 9487007, 9455007, 4, '', '2021-11-28 18:00:00'),
(9455010, 9487003, 9455003, 5, '希望下次還能一起參加活動', '2021-12-03 07:00:00'),
(9455010, 9487005, 9455005, 5, '', '2021-12-20 22:10:00');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `mem_id` int NOT NULL,
  `mem_name` varchar(24) NOT NULL,
  `mem_mail` varchar(40) NOT NULL,
  `mem_pswd` varchar(16) NOT NULL,
  `mem_sex` tinyint NOT NULL COMMENT '0:男 1:女 2:其他',
  `mem_loc` varchar(10) NOT NULL,
  `mem_dom` int NOT NULL DEFAULT '0',
  `mem_money` int DEFAULT '0',
  `jmem_score` int NOT NULL DEFAULT '0',
  `jmem_people` int NOT NULL DEFAULT '0',
  `hmem_score` int NOT NULL DEFAULT '0',
  `hmem_people` int NOT NULL DEFAULT '0',
  `mem_birthday` date NOT NULL,
  `mem_inter` char(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '0:美食 1:夜市 2:學習 3:運動 4:休閒 5:燒腦 6:旅行 7:購物',
  `mem_discribe` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mem_pt` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mem_suspend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未停權 1:停權中'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`mem_id`, `mem_name`, `mem_mail`, `mem_pswd`, `mem_sex`, `mem_loc`, `mem_dom`, `mem_money`, `jmem_score`, `jmem_people`, `hmem_score`, `hmem_people`, `mem_birthday`, `mem_inter`, `mem_discribe`, `mem_pt`, `mem_suspend`) VALUES
(9455001, '黃曉明', 'xaoming@gmail.com', 'ming1234', 0, '台北', 500, 1500, 0, 0, 7, 2, '1989-01-01', '10000100', '嗨~我是黃曉明，是一名工程師。', 'm01.jpg', 0),
(9455002, '郝慧婠', 'playing@yahoo.com.tw', 'play4321', 1, '台中', 200, 2000, 0, 0, 7, 2, '1992-05-15', '11111011', '我很愛交朋友，為人樂觀開朗，很歡迎來佳我好友。', 'm02.jpg', 0),
(9455003, '曾彙倡', 'sing@hotmail.com', 'sing5678', 0, '宜蘭', 250, 800, 20, 5, 4, 1, '1990-03-03', '11110100', '我的夢想是有天成為當紅歌星，與世界分享我美麗的歌聲。', 'm03.jpg', 0),
(9455004, '陳瞰過', 'watch@hotmail.com', 'watchme1', 0, '桃園', 100, 1000, 0, 0, 14, 3, '1985-02-28', '10000100', '', 'm04.jpg', 0),
(9455005, '鄭聰明', 'smart@gmail.com', 'sosmart5', 0, '高雄', 0, 500, 30, 8, 0, 0, '2000-01-27', '10100100', '我的智商180不是騙人的，來參加我開的團，讓你知道什麼叫厲害。', 'm05.jpg', 0),
(9455006, '金前哆', 'money@yahoo.com.tw', 'rich1234', 1, '台北', 600, 3000, 0, 0, 7, 2, '1983-08-30', '01010101', '簡單一句，我錢多來找我血拚，快點!!!!!', 'm06.jpg', 0),
(9455007, '黃美妹', 'pretty@gmail.com', 'pretty55', 1, '南投', 400, 2500, 10, 3, 7, 2, '2003-03-13', '10101010', '', 'm07.jpg', 0),
(9455008, '施雅婷', 'ting@gmail.com', 'jeremy66', 0, '花蓮', 300, 1000, 0, 0, 7, 2, '1995-04-15', '10000100', '', 'm08.jpg', 0),
(9455009, '佛地魔', 'tom@hotmail.com', 'tomr1231', 3, '屏東', 0, 600, 4, 4, 0, 0, '2004-01-09', '01010010', '一直看我的鼻子，小心被我詛咒。', 'm09.jpg', 0),
(9455010, '哈利波特', 'harry@yahoo.com.tw', 'harry0731', 0, '台東', 50, 300, 25, 6, 10, 2, '2001-07-31', '00000010', '人生雖然可能起頭不公平，但只要夠努力人人都有機會出頭天。', 'm10.jpg', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `mem_fav`
--

CREATE TABLE `mem_fav` (
  `mem_id` int NOT NULL,
  `gro_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `mem_fav`
--

INSERT INTO `mem_fav` (`mem_id`, `gro_id`) VALUES
(9455008, 9487001),
(9455010, 9487001),
(9455006, 9487003),
(9455002, 9487005),
(9455010, 9487005),
(9455008, 9487006),
(9455003, 9487007),
(9455005, 9487007);

-- --------------------------------------------------------

--
-- 資料表結構 `partic`
--

CREATE TABLE `partic` (
  `partic_id` int NOT NULL,
  `gro_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `partic`
--

INSERT INTO `partic` (`partic_id`, `gro_id`) VALUES
(9455002, 9487001),
(9455005, 9487001),
(9455008, 9487001),
(9455003, 9487002),
(9455006, 9487002),
(9455009, 9487002),
(9455002, 9487003),
(9455004, 9487003),
(9455006, 9487003),
(9455007, 9487003),
(9455010, 9487003),
(9455003, 9487004),
(9455005, 9487004),
(9455006, 9487004),
(9455001, 9487005),
(9455002, 9487005),
(9455003, 9487005),
(9455004, 9487005),
(9455006, 9487005),
(9455007, 9487005),
(9455008, 9487005),
(9455010, 9487005),
(9455003, 9487006),
(9455007, 9487006),
(9455010, 9487006),
(9455001, 9487007),
(9455004, 9487007),
(9455008, 9487007);

-- --------------------------------------------------------

--
-- 資料表結構 `post`
--

CREATE TABLE `post` (
  `post_no` int NOT NULL,
  `mem_id` int NOT NULL,
  `post_title` varchar(25) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_context` varchar(100) NOT NULL,
  `has_nos` varchar(25) DEFAULT NULL,
  `post_times` int NOT NULL DEFAULT '0',
  `post_like` int NOT NULL DEFAULT '0',
  `post_type` varchar(10) NOT NULL,
  `post_show` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `post`
--

INSERT INTO `post` (`post_no`, `mem_id`, `post_title`, `post_time`, `post_context`, `has_nos`, `post_times`, `post_like`, `post_type`, `post_show`) VALUES
(9453001, 9455001, '踏青好去處', '2021-12-01 20:00:00', '吃喝玩樂樣樣都有，離市區又近的國家公園。四季皆宜的踏青好去處，賞櫻花、梅花、賞楓…四季都有花朵綻放，也可看火山地質結構，草原景緻、湖泊、生態池，還是農場採海芋、繡球花，吃放山雞、野菜、地瓜湯都有。', '7777001', 520, 520, '旅遊', 1),
(9453002, 9455002, '好好吃的義大利麵', '2021-12-01 22:00:00', '很好吃的義大利麵店。這次點了一個茄汁口味的，味道很濃郁但又不會膩口。', '7777002', 660, 660, '美食', 1),
(9453003, 9455003, '紅燒牛肉麵牛雜湯', '2021-12-02 21:00:00', '米其林必比登推薦的乾拌麵和牛雜湯，靠近夜市塔悠路口的「紅燒牛肉麵牛雜湯」攤位。乾拌麵的肉燥是挺香的，但其他無特別的地方，牛雜湯中藥和九層塔有點過濃，蓋住了牛雜的味道。', '7777003', 1234, 666, '美食', 0),
(9453004, 9455004, '百貨公司美食', '2021-12-03 15:00:00', '桃園的在地百貨公司近年翻新之後基本如星巴克、誠品、Studio A、和常見的運動、服飾品牌\n還增加不少聚餐選擇，除了海底撈、果然匯、饗泰多等也有燒丼、moi cafe等較平價選擇。', '7777004', 1314, 777, '其他', 1),
(9453005, 9455005, '八里左岸', '2021-12-03 16:00:00', '很喜歡八里左岸的悠閒時光，每次來這裡都感到很輕鬆自在，可以騎腳踏車也可以看看淡水河，要不是因為工作關係真想搬來這裡住，遠眺文化大學，斜對面就是淡水漁人碼頭跟老街。', '7777005', 1111, 552, '旅遊', 0),
(9453006, 9455006, '出包魔法師', '2021-12-04 13:00:00', '跟一群大學室友(狐群狗黨xd)，掐指一算到訪兩次了。老闆娘可能也對我們沒印象，自認熟門熟路地拿起該款桌遊(出包魔法師)，屢試不爽，真的是淦好玩的> <', '7777006', 500, 323, '其他', 1),
(9453007, 9455007, '打球', '2021-12-05 15:00:00', '在這網站上遇到好幾個愛打球的朋友，現在都會互揪一起打球超爽的', '7777007', 560, 333, '其他', 1),
(9453008, 9455008, '中壢露易莎', '2021-12-06 08:00:00', '準備期末考啦! 中壢露易莎真是個讀書好地方，邊吃邊讀書超爽der~', '7777008', 360, 250, '其他', 1),
(9453009, 9455009, '墾丁旅遊心得', '2021-12-07 17:00:00', '墾丁真是有很多可以玩的地方，去了幾次，每次的地點都可以不太一樣，感受也不同。遊墾丁可以的話還是建議開車，騎車遊墾丁很容易曬黑，加上各地點之間的距離也是個考量。騎車看到的風景不同，有機會還是嘗試嘗試也不', '7777001', 777, 660, '旅遊', 1),
(9453010, 9455010, '好吃的鬆餅', '2021-12-07 19:00:00', '真的太好吃!餐點好吃到家裡挑食的弟弟竟然笑著把一份大鬆餅吃光光', '7777002', 999, 666, '美食', 0),
(9453011, 9455006, 'LOVE', '2021-12-12 23:59:00', '今晚缺伴嗎？今晚想不想來點刺激的？ 歡迎聯絡！！ 聯絡電話： 0912345678', '7777005', 100, 0, '其他', 0),
(9453012, 9455010, '輕鬆賺錢去', '2021-12-15 11:00:00', '小資賺$去～～ 每天花20～30分鐘就可賺取3000～5000元！！ 感興趣的人歡迎聯絡 line：abc12345', '7777004', 100, 0, '其他', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `post_mes`
--

CREATE TABLE `post_mes` (
  `pmes_no` int NOT NULL,
  `post_no` int NOT NULL,
  `mem_id` int NOT NULL,
  `pmes_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pmes_context` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `post_mes`
--

INSERT INTO `post_mes` (`pmes_no`, `post_no`, `mem_id`, `pmes_time`, `pmes_context`) VALUES
(9797001, 9453001, 9455001, '2021-12-01 20:10:00', '我上週才帶我家人去擎天崗哈哈'),
(9797002, 9453002, 9455003, '2021-12-02 23:10:00', '蒜味的我覺得也很好吃'),
(9797003, 9453002, 9455002, '2021-12-03 23:10:00', '今天去吃了，真的讚!!!'),
(9797004, 9453003, 9455004, '2021-12-02 23:00:00', '我超愛饒河夜市吃完還可以去散散步'),
(9797005, 9453004, 9455005, '2021-12-03 16:00:00', '統領真的改變很多好逛又好玩'),
(9797006, 9453004, 9455008, '2021-12-05 19:00:00', '真的，還可以去看電影~~'),
(9797007, 9453005, 9455010, '2021-12-03 17:00:00', '騎腳踏車看看河岸風光很棒!'),
(9797008, 9453006, 9455007, '2021-12-04 15:00:00', '真的可以很自在地玩遊戲好所在，疫情過後一定要再來'),
(9797009, 9453007, 9455008, '2021-12-05 17:00:00', '出社會後能運動的時間越來越短好好珍惜啊!'),
(9797010, 9453008, 9455005, '2021-12-06 17:00:00', '自從去了露易莎後就回不去了'),
(9797011, 9453009, 9455010, '2021-12-07 23:00:00', '墾丁大街有順便逛逛嗎~有海就給讚'),
(9797012, 9453010, 9455001, '2021-12-08 13:00:00', '看起來超好吃的啦!'),
(9797013, 9453010, 9455003, '2021-12-09 15:00:00', '鬆餅控大推~~~~^____^');

-- --------------------------------------------------------

--
-- 資料表結構 `post_pt`
--

CREATE TABLE `post_pt` (
  `ppt_no` int NOT NULL,
  `post_no` int NOT NULL,
  `ppt_pt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `post_pt`
--

INSERT INTO `post_pt` (`ppt_no`, `post_no`, `ppt_pt`) VALUES
(5566001, 9453001, 'picture1.jpg'),
(5566002, 9453001, 'pic-item-2.jpg'),
(5566003, 9453001, 'pic-item-3.jpg'),
(5566004, 9453002, 'picture2.jpg'),
(5566005, 9453003, 'picture3.jpg'),
(5566006, 9453004, 'picture4.jpg'),
(5566007, 9453005, 'picture5.jpg'),
(5566008, 9453006, 'picture6.jpg'),
(5566009, 9453007, 'picture7.jpg'),
(5566010, 9453008, 'picture8.jpg'),
(5566011, 9453009, 'picture9.jpg'),
(5566012, 9453010, 'picture10.jpg'),
(5566013, 9453011, 'picture11.jpg'),
(5566014, 9453012, 'picture12.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `post_report`
--

CREATE TABLE `post_report` (
  `preport_no` int NOT NULL,
  `post_no` int NOT NULL,
  `preport_reason` varchar(60) NOT NULL,
  `preport_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `preport_status` tinyint NOT NULL DEFAULT '0' COMMENT '0:未處理 1:通過 2:不通過'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `post_report`
--

INSERT INTO `post_report` (`preport_no`, `post_no`, `preport_reason`, `preport_time`, `preport_status`) VALUES
(9483001, 9453005, '我看著貼文不爽', '2021-12-05 10:00:00', 0),
(9483002, 9453011, '色情', '2021-12-13 08:00:00', 0),
(9483003, 9453012, '廣告詐欺', '2021-12-15 21:00:00', 0),
(9483004, 9453003, 'La～La～La～', '2021-12-18 23:00:00', 0),
(9483005, 9453010, '我爽', '2021-12-20 14:00:00', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `schedule`
--

CREATE TABLE `schedule` (
  `sche_id` int NOT NULL,
  `gro_id` int NOT NULL,
  `sche_name` varchar(20) NOT NULL,
  `sche_adress` varchar(40) NOT NULL,
  `sche_date` date NOT NULL,
  `sche_starttime` varchar(5) NOT NULL,
  `sche_endtime` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `schedule`
--

INSERT INTO `schedule` (`sche_id`, `gro_id`, `sche_name`, `sche_adress`, `sche_date`, `sche_starttime`, `sche_endtime`) VALUES
(9488001, 9487001, '這一鍋中美店', '320桃園市中壢區中美路一段46號', '2021-11-28', '18:00', '20:00'),
(9488002, 9487002, '桃源仙草花', '326桃園市楊梅區楊湖路三段135號', '2021-11-26', '09:00', '17:00'),
(9488003, 9487003, '新豐夜市', '新豐鄉康泰路、保康街口', '2021-11-29', '18:30', '08:00'),
(9488004, 9487004, '那家咖啡館', '300新竹市北區西大路465號', '2021-11-27', '10:00', '12:00'),
(9488005, 9487005, '陽明籃球場', '330桃園市桃園區長沙街11號', '2021-12-19', '16:00', '18:00'),
(9488006, 9487006, '邏思起子信義店', '台北市信義區松德路12-2號', '2021-12-26', '14:00', '16:00'),
(9488007, 9487007, '好市多Costco 台中店', '408台中市南屯區文心南三路289號', '2021-11-27', '12:00', '13:00'),
(9488008, 9487008, 'Sparrow Hotel', '台中中區中山路175巷15號2樓', '2021-12-02', '00:00', '06:00'),
(9488009, 9487009, '啦啦啦啦', '我家', '2021-12-15', '00:00', '12:00');

-- --------------------------------------------------------

--
-- 資料表結構 `sight`
--

CREATE TABLE `sight` (
  `sig_no` int NOT NULL,
  `sig_name` varchar(20) NOT NULL,
  `sig_describe` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sig_intro` varchar(50) NOT NULL,
  `sig_phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sig_adress` varchar(40) NOT NULL,
  `sig_time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sig_web` varchar(100) DEFAULT NULL,
  `sig_type` varchar(10) NOT NULL,
  `sig_loc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `sight`
--

INSERT INTO `sight` (`sig_no`, `sig_name`, `sig_describe`, `sig_intro`, `sig_phone`, `sig_adress`, `sig_time`, `sig_web`, `sig_type`, `sig_loc`) VALUES
(3333001, '淡水老街', '淡水老街上店面林立，不論是懷舊或是現代店鋪皆有，還有許多淡水著名的傳統美食，像是魚丸、魚酥、阿給、酸梅湯、石花凍、鐵蛋及多樣化的海鮮加工製品等，讓您來到淡水不僅可以賞美景，還可享受眾多新鮮美食。', '位於淡水港邊，歷史悠久且多樣飲食風貌，更因不少古董店及民藝品店進駐，也營造出民俗色彩與懷舊風味。', '', '新北市淡水區中正路', '每日24小時', '', '旅行', '新北市'),
(3333002, '猴硐貓村', '猴硐貓村位於台灣新北市瑞芳區侯硐車站週邊，猴硐地區以兩處平溪線鐵路畫分為兩大景點，一為「猴硐坑礦產園區」，另一個就是「猴硐貓村」。由於貓村在早期便聚集許多貓咪在此棲息，加上貓咪繁殖力強，此處竟成了貓咪棲息地。於是在2009年10月31日透過愛貓人士們發起「有貓相隨，侯硐最美」的活動後，貓咪的居住環境煥然一新。', '猴硐貓村，一個可以療癒身心，可以清淨心靈的城市後花園', '02-24971266', '新北市瑞芳區柴寮路70號 ', '每日24小時', '', '旅行', '新北市'),
(3333003, '綠色走廊', '新屋綠色走廊位於桃園縣新屋鄉，綠色走廊全程共4公里長，由綠蔭大道及濱海道路所組成的休憩區，縣政府為了規劃出完善的人行步道及單車騎乘路線，並增建木棧平台、觀海亭、景觀解說等設施，藍天下綠意盎然的長廊，無時刻的散發著渡假的氛圍，就等著您攜家帶眷享受大自然賜予的自然美景。', '觀海步道可以牽著單車欣賞落日及海景。', '', '桃園市新屋區永安里中山西路三段', '每日24小時', '', '休閒', '桃園市'),
(3333004, '內灣老街', '內灣老街舊時為進出盛產林木及礦產的尖石山區的最主要道路，隨著林業及礦業的沒落而歸於寧靜，經過商圈再造之後，展現全新風貌。內灣老街總長約有200公尺，街道兩旁皆是具有地方特色美食店家和小吃攤商，包含野薑花粽、紫玉菜包、客家擂茶…等客家美食。', '以懷舊的老街情懷帶動了觀光', '', '新竹縣橫山鄉內灣村中正路', '周一至周日  10:00~18:00', '', '旅行', '新竹市'),
(3333005, '勤美誠品綠園道', '勤美誠品位於台中公益路上，一棟被綠色所包圍的建築物，為一棟巧妙結合藝術與商業、充滿創意、時尚與都會潮流的賣場。賣場內有一吸引人的植生牆，植滿整片的綠色、利用植物各種的綠色排列出的波紋，讓人目光深深被吸引。', '這裡可以遇見源源不絕的靈感，然後選擇自己喜歡的放在心中發芽。來這裡不只是採買生活，也能擷取靈感。', '04-23281000', '台中市西區公益路68號', '周一至周日 11:00-21:30 ', 'https://parklane.com.tw/', '購物', '台中市'),
(3333006, '一中商圈', '購物型式多元的一中商圈，包含大型百貨公司、特色化的平價商店和學生最喜愛的夜市小吃，白天為一般商店街，晚上則成為各類服飾及小吃攤販聚集處，各種專賣店、特色服飾小店、主題餐廳、群聚形成多樣化的特色商圈。', '你想的到的這裡都有，來了保證流連忘返。', '04-22314031#325', '台中市北區一中街', '周一至周日 10:00-23:00 ', '', '夜市', '台中市'),
(3333007, '麗寶樂園', '原稱「月眉育樂世界」，是一座結合水上、陸上的主題樂園，園區分成馬拉灣及探索樂園兩大主題樂園，「馬拉灣」提供各種水上遊樂設施，為季節性休園的水上主題樂園，區內許多知名的水上設施-大海嘯、巫師飛艇、鯊魚浪板等，常吸引遊客慕名前來。', '玩樂園、住飯店、逛Outlet、開卡丁、搭摩天輪，一次滿足你的需求。', '04-25582459', '台中市后里區福容路8號', '周一至周日 09:30-17:00 ', 'https://www.lihpaoresort.com/LihpaolandApp', '休閒', '台中市'),
(3333008, '十鼓文化村', '「十鼓文化村」位於十鼓仁糖文創園區，佔地有7.5公頃大，鄰近於台南市區，交通便利卻又遠離塵囂，幽靜的老糖廠透過空間活化，被賦予了全新生命，沿著參觀步道慢行，可見碩大的機具廠房述說過往的輝煌歷史，步上工廠的置高點，還可以鳥瞰園區遼闊風景，格外心曠神怡。', '大人小孩都會喜歡的文化園區', '06-2662225', '台南市仁德區文華路二段326號', '周一至周日 09:00-17:00  18:00-21:00', 'https://tendrum.com.tw/', '休閒', '台南市'),
(3333009, '奇美博物館', '「台南奇美博物館」是由企業家許文龍所創辦，為奇美實業所管轄之私人博物館、美術館。博物館入口即為壯觀的阿波羅噴泉，富麗堂皇、充滿異國風情的大型博物館，堪稱大企業家之典範。進入博物館前，需要經過十二位神祇的眾神之橋才可抵達博物館主要建築，為一處充滿無限價值的典藏區。', '館內外結合西洋神話元素打造特色景點，寄望創建一處大眾共享共賞的園地，成為人們的心靈避風港。', '06-2660808', '臺南市仁德區文華路二段66號', '每日9:30-17:30  週三休館', 'https://www.chimeimuseum.org/', '旅行', '台南市'),
(3333010, '駁二藝術特區', '駁二指的就是第二號接駁碼頭，而駁二倉庫原本是個因使用功能消失而閒置的港口倉庫，民國89年因尋找國慶煙火施放地點的機緣下，讓這個已閒置的倉庫再度的以全新的面貌活了過來，目前駁二倉庫經高雄市文化局規劃成為「駁二藝術特區」，在政府及藝術家以及地方文化工作者的推動下，駁二倉庫已改頭換面成為了藝術家的創作天堂。', '在駁二這個地方，衝突是一股美好的力量。', '07-5214899', '高雄市鹽埕區大勇路1號', '週一二三四  10:00 - 18:00  週五六日   10:00 - 20:00', 'https://pier2.org/', '旅行', '高雄市');

-- --------------------------------------------------------

--
-- 資料表結構 `sight_pt`
--

CREATE TABLE `sight_pt` (
  `spt_no` int NOT NULL,
  `sig_no` int NOT NULL,
  `spt_pt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `sight_pt`
--

INSERT INTO `sight_pt` (`spt_no`, `sig_no`, `spt_pt`) VALUES
(3387001, 3333001, 'tamsui01.jpg'),
(3387002, 3333001, 'tamsui02.jpg'),
(3387003, 3333001, 'tamsui03.jpg'),
(3387004, 3333001, 'tamsui04.jpg'),
(3387005, 3333001, 'tamsui05.jpg'),
(3387006, 3333001, 'tamsui06.jpg'),
(3387007, 3333003, 'greencorridor02.jpg'),
(3387008, 3333003, 'greencorridor03.jpg'),
(3387009, 3333003, 'greencorridor04.jpg'),
(3387010, 3333003, 'greencorridor05.jpg'),
(3387011, 3333003, 'greencorridor06.jpg'),
(3387012, 3333002, 'houtong01.jpg'),
(3387013, 3333002, 'houtong02.jpg'),
(3387014, 3333003, 'greencorridor01.jpg'),
(3387015, 3333004, 'Neiwan01.jpg'),
(3387016, 3333005, 'parklane01.jpg'),
(3387017, 3333006, 'YiZhong01.jpg'),
(3387018, 3333007, 'lihpao01.jpg'),
(3387019, 3333008, 'tendrum01.jpg'),
(3387020, 3333009, 'chimei01.jpg'),
(3387022, 3333009, 'chimei02.jpg'),
(3387023, 3333009, 'chimei03.jpg'),
(3387024, 3333009, 'chimei04.jpg'),
(3387025, 3333009, 'chimei05.jpg'),
(3387026, 3333009, 'chimei06.jpg'),
(3387027, 3333002, 'houtong03.jpg'),
(3387028, 3333002, 'houtong04.jpg'),
(3387029, 3333002, 'houtong05.jpg'),
(3387030, 3333002, 'houtong06.jpg'),
(3387031, 3333007, 'lihpao02.jpg'),
(3387032, 3333007, 'lihpao03.jpg'),
(3387033, 3333007, 'lihpao04.jpg'),
(3387034, 3333007, 'lihpao05.jpg'),
(3387035, 3333007, 'lihpao06.jpg'),
(3387036, 3333004, 'Neiwan02.jpg'),
(3387037, 3333004, 'Neiwan03.jpg'),
(3387038, 3333004, 'Neiwan04.jpg'),
(3387039, 3333004, 'Neiwan05.jpg'),
(3387040, 3333004, 'Neiwan06.jpg'),
(3387041, 3333005, 'parklane02.jpg'),
(3387042, 3333005, 'parklane03.jpg'),
(3387043, 3333005, 'parklane04.jpg'),
(3387044, 3333005, 'parklane05.jpg'),
(3387045, 3333005, 'parklane06.jpg'),
(3387046, 3333008, 'tendrum02.jpg'),
(3387047, 3333008, 'tendrum03.jpg'),
(3387048, 3333008, 'tendrum04.jpg'),
(3387049, 3333008, 'tendrum05.jpg'),
(3387050, 3333008, 'tendrum06.jpg'),
(3387051, 3333006, 'YiZhong02.jpg'),
(3387052, 3333006, 'YiZhong03.jpg'),
(3387053, 3333006, 'YiZhong04.jpg'),
(3387054, 3333006, 'YiZhong05.jpg'),
(3387055, 3333006, 'YiZhong06.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `stamp_style`
--

CREATE TABLE `stamp_style` (
  `sstyle_no` int NOT NULL,
  `sstyle_name` varchar(20) NOT NULL,
  `sstyle_pt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `stamp_style`
--

INSERT INTO `stamp_style` (`sstyle_no`, `sstyle_name`, `sstyle_pt`) VALUES
(115001, '愛裝可愛的柯基', 'dog.png'),
(115002, '幽浮貓咪', 'ufo.png'),
(115003, '星空瓶', 'can.png'),
(115004, '我家的鑰匙', 'key.png'),
(115005, '超級開心', 'happy.png'),
(115006, '蟹蟹尼', 'thanks.png'),
(115007, '一捲衛生紙', 'toilet_paper.png'),
(115008, '傘電~傘電~', 'thunder.png'),
(115009, '愛心一號', 'heart.png'),
(115010, '愛心二號', 'heart_2.png'),
(115011, '盆栽裡的仙人掌', 'plant.png');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- 資料表索引 `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`mem_id`,`block_id`),
  ADD KEY `block_id` (`block_id`);

--
-- 資料表索引 `card_style`
--
ALTER TABLE `card_style`
  ADD PRIMARY KEY (`cstyle_no`);

--
-- 資料表索引 `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`mem_id`,`friend_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- 資料表索引 `gro_mes`
--
ALTER TABLE `gro_mes`
  ADD PRIMARY KEY (`gmes_no`),
  ADD KEY `gro_id` (`gro_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- 資料表索引 `gro_pt`
--
ALTER TABLE `gro_pt`
  ADD PRIMARY KEY (`gpt_no`),
  ADD KEY `gro_id` (`gro_id`);

--
-- 資料表索引 `gro_report`
--
ALTER TABLE `gro_report`
  ADD PRIMARY KEY (`greport_no`),
  ADD KEY `gro_id` (`gro_id`);

--
-- 資料表索引 `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`has_no`);

--
-- 資料表索引 `host_rate`
--
ALTER TABLE `host_rate`
  ADD PRIMARY KEY (`mem_id`,`gro_id`),
  ADD KEY `gro_id` (`gro_id`),
  ADD KEY `host_id` (`host_id`);

--
-- 資料表索引 `igroup`
--
ALTER TABLE `igroup`
  ADD PRIMARY KEY (`gro_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- 資料表索引 `join_rate`
--
ALTER TABLE `join_rate`
  ADD PRIMARY KEY (`join_id`,`gro_id`),
  ADD KEY `gro_id` (`gro_id`),
  ADD KEY `host_id` (`host_id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`),
  ADD UNIQUE KEY `mem_mail` (`mem_mail`);

--
-- 資料表索引 `mem_fav`
--
ALTER TABLE `mem_fav`
  ADD PRIMARY KEY (`mem_id`,`gro_id`),
  ADD KEY `gro_id` (`gro_id`);

--
-- 資料表索引 `partic`
--
ALTER TABLE `partic`
  ADD PRIMARY KEY (`partic_id`,`gro_id`),
  ADD KEY `gro_id` (`gro_id`);

--
-- 資料表索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_no`),
  ADD KEY `mem_id` (`mem_id`);

--
-- 資料表索引 `post_mes`
--
ALTER TABLE `post_mes`
  ADD PRIMARY KEY (`pmes_no`),
  ADD KEY `mem_id` (`mem_id`),
  ADD KEY `post_no` (`post_no`);

--
-- 資料表索引 `post_pt`
--
ALTER TABLE `post_pt`
  ADD PRIMARY KEY (`ppt_no`),
  ADD KEY `post_no` (`post_no`);

--
-- 資料表索引 `post_report`
--
ALTER TABLE `post_report`
  ADD PRIMARY KEY (`preport_no`),
  ADD KEY `post_no` (`post_no`);

--
-- 資料表索引 `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sche_id`),
  ADD KEY `gro_id` (`gro_id`);

--
-- 資料表索引 `sight`
--
ALTER TABLE `sight`
  ADD PRIMARY KEY (`sig_no`);

--
-- 資料表索引 `sight_pt`
--
ALTER TABLE `sight_pt`
  ADD PRIMARY KEY (`spt_no`),
  ADD KEY `sig_no` (`sig_no`);

--
-- 資料表索引 `stamp_style`
--
ALTER TABLE `stamp_style`
  ADD PRIMARY KEY (`sstyle_no`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `card_style`
--
ALTER TABLE `card_style`
  MODIFY `cstyle_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67007;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `gro_mes`
--
ALTER TABLE `gro_mes`
  MODIFY `gmes_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9488004;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `gro_pt`
--
ALTER TABLE `gro_pt`
  MODIFY `gpt_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9489019;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `gro_report`
--
ALTER TABLE `gro_report`
  MODIFY `greport_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9484006;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `has_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7777006;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `igroup`
--
ALTER TABLE `igroup`
  MODIFY `gro_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9487010;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `mem_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9455011;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post`
--
ALTER TABLE `post`
  MODIFY `post_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9453013;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_mes`
--
ALTER TABLE `post_mes`
  MODIFY `pmes_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9797016;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_pt`
--
ALTER TABLE `post_pt`
  MODIFY `ppt_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5566015;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_report`
--
ALTER TABLE `post_report`
  MODIFY `preport_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9483006;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sche_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9488010;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sight`
--
ALTER TABLE `sight`
  MODIFY `sig_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3333011;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sight_pt`
--
ALTER TABLE `sight_pt`
  MODIFY `spt_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3387056;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `stamp_style`
--
ALTER TABLE `stamp_style`
  MODIFY `sstyle_no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115012;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `block_ibfk_2` FOREIGN KEY (`block_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `gro_mes`
--
ALTER TABLE `gro_mes`
  ADD CONSTRAINT `gro_mes_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `gro_mes_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `gro_pt`
--
ALTER TABLE `gro_pt`
  ADD CONSTRAINT `gro_pt_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `gro_report`
--
ALTER TABLE `gro_report`
  ADD CONSTRAINT `gro_report_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `host_rate`
--
ALTER TABLE `host_rate`
  ADD CONSTRAINT `host_rate_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `host_rate_ibfk_2` FOREIGN KEY (`host_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `host_rate_ibfk_3` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `igroup`
--
ALTER TABLE `igroup`
  ADD CONSTRAINT `igroup_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `join_rate`
--
ALTER TABLE `join_rate`
  ADD CONSTRAINT `join_rate_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `join_rate_ibfk_2` FOREIGN KEY (`host_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `join_rate_ibfk_3` FOREIGN KEY (`join_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `mem_fav`
--
ALTER TABLE `mem_fav`
  ADD CONSTRAINT `mem_fav_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `mem_fav_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `partic`
--
ALTER TABLE `partic`
  ADD CONSTRAINT `partic_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `partic_ibfk_2` FOREIGN KEY (`partic_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `post_mes`
--
ALTER TABLE `post_mes`
  ADD CONSTRAINT `post_mes_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `member` (`mem_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `post_mes_ibfk_2` FOREIGN KEY (`post_no`) REFERENCES `post` (`post_no`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `post_pt`
--
ALTER TABLE `post_pt`
  ADD CONSTRAINT `post_pt_ibfk_1` FOREIGN KEY (`post_no`) REFERENCES `post` (`post_no`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `post_report`
--
ALTER TABLE `post_report`
  ADD CONSTRAINT `post_report_ibfk_1` FOREIGN KEY (`post_no`) REFERENCES `post` (`post_no`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`gro_id`) REFERENCES `igroup` (`gro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制式 `sight_pt`
--
ALTER TABLE `sight_pt`
  ADD CONSTRAINT `sight_pt_ibfk_1` FOREIGN KEY (`sig_no`) REFERENCES `sight` (`sig_no`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

-- 新增使用者
CREATE USER 'tibamefe_since2021`@`localhost' IDENTIFIED BY 'vwRBSB.j&K#E';
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO `tibamefe_since2021`@`localhost`;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
