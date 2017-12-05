-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017 年 10 朁E31 日 11:11
-- サーバのバージョン： 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employment`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_project_industry`
--

CREATE TABLE `mst_project_industry` (
  `mst_id` int(11) NOT NULL,
  `mst_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT '案件種別名',
  `mst_print_number` int(11) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_project_industry`
--

INSERT INTO `mst_project_industry` (`mst_id`, `mst_name`, `mst_print_number`, `delete_flg`) VALUES
(1, 'その他', 1, 0),
(2, '金融', 2, 0),
(3, '保険', 3, 0),
(4, '人材', 4, 0),
(5, '医療', 5, 0),
(6, '官公庁', 6, 0),
(7, '物流', 7, 0),
(8, '通信', 8, 0),
(9, '製造業', 9, 0),
(10, 'ゲーム', 10, 0),
(11, 'WEB', 11, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_project_kind`
--

CREATE TABLE `mst_project_kind` (
  `mst_id` int(11) NOT NULL COMMENT 'ID',
  `mst_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT '種別名',
  `mst_print_number` int(11) NOT NULL COMMENT '表示順',
  `pickup_flg` tinyint(1) NOT NULL COMMENT 'ピックアップフラグ',
  `delete_flg` tinyint(1) NOT NULL COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_project_kind`
--

INSERT INTO `mst_project_kind` (`mst_id`, `mst_name`, `mst_print_number`, `pickup_flg`, `delete_flg`) VALUES
(1, '一般', 1, 0, 0),
(2, '即決', 2, 1, 0),
(3, '高角度', 3, 1, 0),
(4, '面接１回', 4, 1, 0),
(5, '増員案件', 5, 1, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_project_phase`
--

CREATE TABLE `mst_project_phase` (
  `mst_id` int(11) NOT NULL COMMENT 'ID',
  `mst_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT '業務名',
  `mst_img_path` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `mst_print_number` int(11) NOT NULL COMMENT '表示順',
  `delete_flg` tinyint(1) NOT NULL COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_project_phase`
--

INSERT INTO `mst_project_phase` (`mst_id`, `mst_name`, `mst_img_path`, `mst_print_number`, `delete_flg`) VALUES
(1, '開発', '', 1, 0),
(2, '保守・運用', '', 2, 0),
(3, 'インフラ・ネットワーク', '', 3, 0),
(4, 'ヘルプデスク・サポート', '', 4, 0),
(5, 'テスト', '', 5, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_user`
--

CREATE TABLE `mst_user` (
  `mst_user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザーID',
  `mst_user_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ユーザー名',
  `mst_user_password` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'パスワード'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_user`
--

INSERT INTO `mst_user` (`mst_user_id`, `mst_user_name`, `mst_user_password`) VALUES
('admin', '管理者', 'pass');

-- --------------------------------------------------------

--
-- テーブルの構造 `t_engineer`
--

CREATE TABLE `t_engineer` (
  `t_engineer_id` int(11) NOT NULL COMMENT '会員番号',
  `t_engineer_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '氏名',
  `t_engineer_kana` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '氏名（かな）',
  `t_engineer_gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '性別',
  `t_engineer_birthday` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '生年月日',
  `t_engineer_mail_address` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'メールアドレス',
  `t_engineer_phone_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電話番号',
  `t_engineer_experience` int(11) DEFAULT NULL COMMENT '実務経験年数',
  `t_engineer_price` int(11) DEFAULT NULL COMMENT '希望単価',
  `t_engineer_skill` text COLLATE utf8_unicode_ci COMMENT 'スキル',
  `t_engineer_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '登録状態',
  `t_engineer_other` text COLLATE utf8_unicode_ci COMMENT '備考',
  `t_engineer_update_date` datetime NOT NULL COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='エンジニアテーブル';

--
-- テーブルのデータのダンプ `t_engineer`
--

INSERT INTO `t_engineer` (`t_engineer_id`, `t_engineer_name`, `t_engineer_kana`, `t_engineer_gender`, `t_engineer_birthday`, `t_engineer_mail_address`, `t_engineer_phone_number`, `t_engineer_experience`, `t_engineer_price`, `t_engineer_skill`, `t_engineer_status`, `t_engineer_other`, `t_engineer_update_date`) VALUES
(1, 'タマタマ更新', 'たまたま', '男性', '19700518', 'k-tamaki@k-mit.jp', '03-1111-1111', NULL, NULL, NULL, 'メール送信済', '更新', '2017-10-31 15:42:41'),
(2, 'タマ２号', 'たまにごう', '男性', '19801114', 'tama@co.jp', '03-1111-1111', NULL, NULL, NULL, 'メール受信', 'あああああ\r\nいいいいい\r\nううううう', '2017-10-31 15:42:41'),
(3, 'たま３号', 'たまさんごう', '女性', '19600101', 'tama@.co.jp', '03-1111-1111', NULL, NULL, NULL, 'メール送信済', 'bbbbb\r\nccccc', '2017-10-31 15:42:41'),
(4, 'たま４号', 'たまよんごう', '男性', '19991231', 'tamatamatama@co.jp', '03-9999-9999', NULL, NULL, NULL, '本登録', '更新更新', '2017-10-31 15:42:41'),
(5, 'たま５号', 'たまごごう', '女性', '19600101', 'tama@co.jp', '03-1111-1111', NULL, NULL, NULL, 'メール受信', '備考５', '2017-10-31 15:42:41'),
(6, '渡辺　雄太', 'わたなべゆうた', '男性', '19700101', 'ytwata1981@gmail.com', '0451234567', NULL, NULL, NULL, 'メール送信済', 'テスト', '2017-10-31 15:42:41');

-- --------------------------------------------------------

--
-- テーブルの構造 `t_project`
--

CREATE TABLE `t_project` (
  `t_project_id` int(11) NOT NULL COMMENT '案件番号',
  `t_project_subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '案件名',
  `t_project_kind_id` int(11) NOT NULL COMMENT '案件種別ID',
  `t_project_industry_id` int(11) NOT NULL COMMENT '業種ID',
  `t_project_phase_id` int(11) NOT NULL COMMENT '業務ID',
  `t_project_skill` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'スキル',
  `t_project_price` int(11) DEFAULT NULL COMMENT '金額',
  `t_project_location` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '勤務場所',
  `t_project_detail` text COLLATE utf8_unicode_ci COMMENT '案件内容',
  `t_project_business_partner` text COLLATE utf8_unicode_ci COMMENT '案件提供会社',
  `t_project_remarks` text COLLATE utf8_unicode_ci COMMENT '備考',
  `t_project_update_date` datetime NOT NULL COMMENT '更新日時',
  `delete_flg` tinyint(1) DEFAULT NULL COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='案件情報テーブル';

--
-- テーブルのデータのダンプ `t_project`
--

INSERT INTO `t_project` (`t_project_id`, `t_project_subject`, `t_project_kind_id`, `t_project_industry_id`, `t_project_phase_id`, `t_project_skill`, `t_project_price`, `t_project_location`, `t_project_detail`, `t_project_business_partner`, `t_project_remarks`, `t_project_update_date`, `delete_flg`) VALUES
(1, 'てすと案件１', 1, 2, 3, 'てすとスキル１ ', 99999, 'てすと勤務場所', 'かきくけこ\r\nさしすせそ', NULL, 'てすと備考', '2017-10-31 15:39:44', 0),
(2, 'てすと案件２', 1, 2, 3, 'スキル２', 11, '勤務場所２', '案件内容２', NULL, '備考２', '2017-10-31 15:39:44', 0),
(3, 'てすと案件３', 1, 2, 3, 'スキル３', 999999, '勤務場所３', '案件内容３', '', '備考３', '2017-10-31 15:39:44', 0),
(4, 'てすと案件４', 1, 2, 3, 'スキル４', 44444, '勤務場所４', '案件内容４', NULL, '備考４', '2017-10-31 15:39:44', 0),
(5, 'てすと案件５', 1, 2, 3, 'スキル５', 55555, '勤務場所５', '案件内容５', NULL, '備考５', '2017-10-31 15:39:44', 0),
(6, 'てすと案件６', 1, 2, 3, 'スキル６', 66666, '勤務場所６', '案件内容６', '', '備考６', '2017-10-31 15:39:44', 0),
(7, 'てすと案件７', 1, 2, 3, 'スキル７', 77777, '勤務場所７', '案件内容７', NULL, '備考７', '2017-10-31 15:39:44', 0),
(8, 'てすと案件８', 1, 2, 3, 'スキル８', 88888, '勤務場所８', '案件内容８', NULL, '備考８', '2017-10-31 15:39:44', 0),
(9, 'てすと案件９', 1, 2, 3, 'スキル９', 99999, '勤務場所９', '案件内容９', NULL, '備考９', '2017-10-31 15:39:44', 0),
(10, 'てすと案件１０', 1, 2, 3, 'スキル１０', 100000, '勤務場所１０', '案件内容１０', NULL, '備考１０', '2017-10-31 15:39:44', 0),
(11, '【Java】オープン開発', 1, 8, 5, 'Java', 700000, '品川', 'テストです', 'ITエージェント', 'テストです', '2017-10-31 19:07:11', 0),
(12, 'aaa', 1, 2, 3, 'aaa', 111, 'aaa', 'aaa', 'aaa', 'aaa', '2017-10-31 15:39:44', 0),
(13, 'qqqq', 1, 2, 3, 'qqqqqqq', 987, 'qqqqqq', 'qqqqq', 'qqqqqqq', 'qqqqqq', '2017-10-31 15:39:44', 1),
(14, 'qqqq', 1, 2, 3, 'qqqqqqq', 987, 'qqqqqq', 'qqqqq', 'qqqqqqq', 'qqqqqq', '2017-10-31 15:39:44', 1),
(15, 'ddddd', 1, 2, 3, 'ddddd', 1111, 'ddddd', '', 'dd', '', '2017-10-31 15:39:44', 0),
(16, 'abc', 1, 2, 3, '', 0, '', '', '', '', '2017-10-31 15:39:44', 0),
(17, 'ああああ', 1, 2, 3, 'Java', 9000, '品川', 'ううう', 'ああああ', 'ええええ', '2017-10-31 15:39:44', 0),
(18, '12555', 1, 2, 3, '', 0, '', '', '', '', '2017-10-31 15:39:44', 0),
(19, 'えー', 1, 2, 3, '', 0, '', '', '', '', '2017-10-31 15:39:44', 1),
(20, 'えー', 1, 2, 3, '', 0, '', '', '', '', '2017-10-31 15:39:44', 0),
(21, '会計システム運用保守業務(あとで消す)', 2, 2, 2, 'オープン系の基本設計の経験豊富な方,SAP,VB6.0', 650000, '～1月末：川崎', '【内容】某大手企業の会計システムの運用保守業務\r\n　　　　企画・提案やエンハンス対応\r\n　　　　今回は基本設計を主にご担当いただける方を募集します。\r\n　　　　開発は別部隊が行います。\r\n　　　　成果物の受け入れテスト、\r\n　　　　また結合テストも担当いただきます。', '株式会社　マジックウェイ\r\n営業部\r\nTEL：03-5807-3834(代表)\r\nFAX：03-5807-3835\r\nMail：mgw_eigyo@magicway.co.jp', '【期間】11月～長期（開始を遅らすご相談可）\r\n\r\n【スキル】オープン系の基本設計の経験豊富な方\r\n　　　　　（プログラミングスキル不要）\r\n　　　　　受け入れテスト、結合テスト経験\r\n\r\n【環境】SAP、VB6.0など（必須ではありません）\r\n\r\n【単金】60～65万（精算固定）※稼働実績は数年安定しております\r\n\r\n【人数】1名\r\n\r\n【面接回数】1回（弊社同席）\r\n\r\n【備考】弊社参画中の案件です（増員枠）\r\n　　　　外国籍不可\r\n　　　　40歳-50歳まで\r\n==========================================================', '2017-10-31 19:06:54', 0),
(22, '某メガバンク社内事務システムのリプレース開発（製造～テスト作業）', 2, 4, 1, 'Java,JavaScript,HTML,続く', 800000, '新川崎駅', '　　某メガバンク社内事務システムのリプレース開発\r\n　　（製造～テスト作業）', 'ＮＤＳ　日本データスキル（株）\r\n　　　　システム事業部　第１システム本部　第２部\r\n　　　　岸原　幸治\r\n　　　　〒221-0052\r\n　　　　横浜市神奈川区栄町1番地1\r\n　　　　　ＫＤＸ横浜ビル\r\n　　　　tel　(045)451-3200(代)\r\n　　　　fax　(045)451-4155\r\n　　　　Mail kishihara@nds.co.jp', '４．作業期間\r\n　　１１月～３／末（延長の可能性あり）\r\n\r\n５．募集要員\r\n　　２名\r\n\r\n６．面談\r\n　　１回\r\n\r\n７．契約形態\r\n　　準委任または派遣\r\n\r\n８．単金\r\n　　スキル見合い（精算あり）\r\n\r\n９．その他\r\n　　・外国籍不可\r\n　　・コミュニケーションが良好な方\r\n　　・付きっきりにならずお願いした作業を自身で進められる方', '2017-10-31 16:55:52', 0),
(23, '通信機器（端末・基地局）の設計および開発（設計～テスト作業）', 1, 2, 3, 'RTOS,C言語,kernel,ドライバ,アプリ', 0, '桜木町，横浜または川', '通信機器（端末・基地局）の設計および開発（設計～テスト作業）', 'ＮＤＳ　日本データスキル（株）\r\n　　　　システム事業部　第１システム本部　第２部\r\n　　　　岸原　幸治\r\n　　　　〒221-0052\r\n　　　　横浜市神奈川区栄町1番地1\r\n　　　　　ＫＤＸ横浜ビル\r\n　　　　tel　(045)451-3200(代)\r\n　　　　fax　(045)451-4155\r\n　　　　Mail kishihara@nds.co.jp', '２．必要スキル\r\n　　＜必須＞\r\n　　　・組込み開発経験(RTOS,C言語etc)\r\n　　　・Linux有識者(kernel,ドライバ,アプリetc)\r\n　　＜尚良＞\r\n　　　・ネットワーク、無線通信プロトコルの知識(LTE,WCDMA,TCP/IP etc)\r\n　　　・端末,基地局の開発、評価経験\r\n\r\n３．作業場所\r\n　　桜木町，横浜または川崎\r\n\r\n４．作業期間\r\n　　１１月以降～長期\r\n　　※１１月中や１２月も可能です。\r\n\r\n５．募集要員\r\n　　２名\r\n\r\n６．面談\r\n　　１回\r\n\r\n７．契約形態\r\n　　準委任または派遣\r\n\r\n８．単金\r\n　　スキル見合い（精算あり）\r\n\r\n９．その他\r\n　　・外国籍不可\r\n　　・コミュニケーションが良好な方\r\n\r\n', '2017-10-31 15:39:44', 0),
(24, '現調/卓操作（手順書）作成業務', 1, 2, 3, 'NW知識', 370000, '東京駅', '手順書作成、ｺﾝﾌｨｸﾞ作成、ｼｽﾃﾑ立上げ', '株式会社TECHTONE\r\n営業本部：宮尾　芳博\r\n          -- Miyao Yoshihiro --\r\n〒160-0022\r\n東京都新宿区新宿6-29-8　新宿福智ビル5F.6Ｆ\r\nTEL：03-5155-4844(代表)\r\nFAX：03-5155-4845\r\nH/P：070-6465-7656\r\nE-mail：eigyo@techtone.biz', '作業期間 ：11/1～2018/6末（継続予定）\r\n作業場所 ：東京駅\r\nス キ ル  :下記NWについての知識\r\n　　　　　（光ｹｰﾌﾞﾙ関連、ルータ関連）\r\n　　　　　 TeraTerm操作経験\r\n作業内容 ：手順書作成、ｺﾝﾌｨｸﾞ作成、ｼｽﾃﾑ立上げ\r\n募集人数 ：2名\r\n金　　額 ：37万円MAX（精算確認中）\r\n備　　考 ：卓操作経験者と伝送装置経験者歓迎\r\n           面談1回', '2017-10-31 15:39:44', 0),
(25, 'インフラ部署でのサポート業務', 1, 2, 3, 'Officeスキル,庶務経験', 380000, '飯田橋', '庶務（テプラ、会議室予約、その他雑務）\r\n　　　ドキュメント作成修正（Excel、Word）\r\n　　　　PMサポート（議事録作成）', '株式会社TECHTONE\r\n第4営業部：高橋　信明\r\n 　　　　　- Takahashi Nobuaki -\r\n〒160-0022\r\n東京都新宿区新宿6-29-8\r\n　　　　　　新宿福智ビル5F・6F（受付）\r\nTEL：03-5155-4844(代表)\r\nFAX：03-5155-4845\r\nWILLCOM：070-6510-5036\r\nE-mail：eigyo@techtone.biz', '案件：インフラ部署でのサポート業務\r\n場所：飯田橋\r\n期間：即～長期（決定～入場まで5営業日必須）\r\n作業：庶務（テプラ、会議室予約、その他雑務）\r\n　　　ドキュメント作成修正（Excel、Word）\r\n　　　　PMサポート（議事録作成）\r\nスキル：・Officeスキルの高い方\r\n　　　　・庶務経験\r\n　　　　・気が利く方、細かい作業できる方\r\n　　　　・議事録作成経験（尚可）\r\n　　　　・IT業界経験（NW知識尚可）\r\n　　　　・CCNA保持者（尚可）\r\n単金：35-38万　※140-180H\r\n募集：1名（交代枠）\r\n面談：1回（高橋同席）\r\n年齢：35歳までの女性\r\n備考：外国籍不可。\r\n　　　9：00-17：30（稼働に並はありますが180Hは超えてないです）\r\n　　　PJによっては日帰りでの出張あり（現状三島など）\r\n　　　都内への出張（おつかい）あり\r\n', '2017-10-31 15:39:44', 0),
(26, '金融機関向けシステム開発支援(時給）あとで消す', 1, 2, 3, 'Shell,Powershell', 0, '茅場町', '作業内容　：JP1と連動させるshellをB-shellと\r\n　　　　　　Powershellで製造する。\r\n　　　　　　B-shellが7割、Powershellが3割くらい', '株式会社TECHTONE\r\n第5営業部：高橋　毅（たけし）\r\n\r\n〒160-0022\r\n東京都新宿区新宿6-29-8　新宿福智ビル6Ｆ(受付)\r\nTEL：03-5155-4844(代表)\r\nFAX：03-5155-4845\r\nhandy：090-8495-7286\r\nE-mail：takahashi@techtone.biz（個人）\r\n　　　　 eigyo@techtone.biz（共通）', '作業期間　：11月～2018年1月\r\n　　　　　　※延長の可能性あり\r\n作業場所　：茅場町\r\nス  キ  ル　：Shellの開発経験\r\n　　　　　　Powershellの経験\r\n作業内容　：JP1と連動させるshellをB-shellと\r\n　　　　　　Powershellで製造する。\r\n　　　　　　B-shellが7割、Powershellが3割くらい\r\n金　　額　：時給になります\r\n　　　　　　※目安3,200円～3,400円くらい\r\n　　　　　　　稼働は月180Ｈぐらい\r\n面　　談　：1回\r\n　　　　　　※10/26(木)に面談できます（時間応相談）\r\n備　　考　：外国籍不可\r\n\r\n以上\r\nよろしくお願いいたします。\r\n', '2017-10-31 15:39:44', 0),
(27, 'ERPパッケージ　開発（調査分析、要件定義、設計、評価）あとで消す', 1, 2, 3, '調査分析・要件定義・設計などの上流経験', 720000, '浜松町', '基本設計～詳細設計、評価\r\n設計業務がメイン作業になりますが不明瞭なものに対し、\r\n自発的に動いて形にしていただく必要がございます。\r\nまた、開発はオフショアのため、製造・テスト等に携わる事はないです。', '株式会社エクストリーム（証券コード：6033）\r\n山﨑　琢磨\r\n携帯　070-6529-0787　※sms利用可。\r\nEmail  takuma-yamasaki@e-xtreme.co.jp', '商流：エンド→弊社\r\n期間：11月～1月（延長有り）※入場時期は相談可\r\n単価：72万前後（140－180h）※スキル見合い\r\n人数：４名\r\n面談：1回(弊社同席）\r\nスキル：調査分析・要件定義・設計などの上流経験。\r\n　　　 （開発はオフショアのため開発経験は不問。JAVAの知見があると尚可）\r\n　　　　待ちの姿勢ではなく自発的に行動が出来ること。\r\n　　　　アバウトな情報や指示に対し、なにもできないような方ですと厳しいです。\r\n備考：外国籍の方NG。できれば50歳代前半までを希望。\r\n　　　商流は問いませんが再委託は実績ある方希望。', '2017-10-31 15:39:44', 0),
(28, '省電力サーバの導入に伴う検証と運用案件', 1, 2, 3, 'Linux経験,サーバ導入経験', 650000, '代々木', '・サーバ導入時におけるユーザーサイドとの調整、検証\r\n・導入後の運用', '株式会社hacks - http://hacks.co.jp\r\n\r\n渡辺　まお　Mao Watanabe\r\n\r\nPhone：070-3229-2769\r\n個人：mwatanabe@hacks.co.jp\r\n共通：sales@hacks.co.jp', '商流：エンド→元請け→弊社\r\n場所：代々木\r\n期間：即日or11月?長期\r\n単価：完全スキル見合い（MAX60?65万円）\r\n精算：140-200h\r\n面談：1回\r\n定時：10:00～19:00\r\n募集：2名\r\n備考：年齢不問、外国籍不可\r\n\r\n＜業務内容＞\r\n・サーバ導入時におけるユーザーサイドとの調整、検証\r\n・導入後の運用\r\n\r\n＜必須スキル＞\r\n・Linux経験\r\n・サーバ導入経験\r\n・サーバの構築、運用、保守経験\r\n・ネットワークの経験\r\n\r\n＜尚可スキル＞\r\n・サーバ設計経験\r\n・ネットワークの設計経験\r\n・各種シェルプログラミングの使用経験\r\n・プログラミング言語を扱える（Python、PHP、Perl、C、C++、Javaなど)\r\n・VMWare, KVMの構築・運用経験\r\n・AWSの利用経験', '2017-10-31 15:39:44', 0),
(29, '男性向け事務・サポート業務', 1, 2, 3, 'Excel/Wordを仕様した事務職', 0, '品川', '・金融機関向けの工事調整業務\r\n・金融機関からの端末の増減や、店舗の開店・廃店などの依頼を受け、どのような工事が発生するかを確認して、工事に伴う作業の日程調整や作業の指示出しを行います。', '山本直樹：090-7815-3299\r\nyamamoto@isa-plan.jp\r\n\r\n佐川厚子：070-2682-1211\r\nsagawa@isa-plan.jp\r\n\r\n村越優耶：080-2259-0713\r\nmurakoshi@isa-plan.jp\r\n\r\n川奈野将司：080-8474-6614\r\nkawanano@isa-plan.jp\r\n\r\n\r\n■We commit achievement of\r\n■        　the business strategy of your company.\r\n□\r\n□　 株式会社アイエスエイプラン　【ISA  Plan , Inc.】', '期 間：即～長期\r\n場 所：品川\r\nスキル：・Excel/Wordを仕様した事務職/HD等での実務経験経験1～2年以上\r\n　　　　・勤怠に問題の無い方\r\n　　　　・コミュニケーション力に優れた方\r\n　　　　　　⇒報連相がしっかりできる方\r\n　　　　　　⇒明るい方　等\r\n面 談：2回（1回目弊社同席）\r\n単 金：ご提示ください\r\n精 算：固定\r\n定 時：9:00～18:00\r\n人 数：2名\r\nB  P：御社まで\r\n外国籍：NG\r\n備 考：・弊社から2名参画中の案件となります。\r\n　　　・前任者が男性だったため、男性で探しております。', '2017-10-31 15:39:44', 0),
(30, 'サーバ系システムの運用保守（保守系SE）', 1, 2, 3, 'Windows、Unix、Oracleの基礎知識,業務経験', 0, '吉祥寺～ バスで8分', '・保守定例作業／オペレーション作業\r\n・障害対応（1次解析、復旧作業など）\r\n・顧客対応（お客様報告、調整など）', '山本直樹：090-7815-3299\r\nyamamoto@isa-plan.jp\r\n\r\n佐川厚子：070-2682-1211\r\nsagawa@isa-plan.jp\r\n\r\n村越優耶：080-2259-0713\r\nmurakoshi@isa-plan.jp\r\n\r\n川奈野将司：080-8474-6614\r\nkawanano@isa-plan.jp\r\n\r\n\r\n■We commit achievement of\r\n■        　the business strategy of your company.\r\n□\r\n□　 株式会社アイエスエイプラン　【ISA  Plan , Inc.】\r\n□　\r\n□   〒104-6230　東京都中央区晴海1-8-12トリトンスクエアZ 30F\r\n□□　Tel:03-3532-1466　Fax:03-3532-0155   \r\n□□　construction@isa-plan.jp（Sales）', '期　間：11月～ 長期\r\n場　所：吉祥寺～ バスで8分\r\nスキル：＜必須＞\r\n　　　・ヒューマンスキル（コミュニケーション能力、積極性）\r\n　　　・Windows、Unix、Oracleの基礎知識／業務経験\r\n　　　・基本情報技術者試験相当の知識\r\n面　談：1回\r\n単　金：スキル見合い\r\n精　算：150 - 200\r\n定　時：9:00 - 17:45（シフト勤務あり）\r\n人　数：4名\r\nB　  P：不可\r\n外国籍：不可\r\n備　考：長期的に参画頂ける方\r\n　　　　勤怠、体調が良好な方\r\n　　　　年齢は30代まで\r\n　　　　吉祥寺駅まで1時間圏内を希望\r\n　　　　弊社から15名参画しているプロジェクトです\r\nーーーーーーーーーーーーーーーーーーーーーーー', '2017-10-31 15:39:44', 0),
(31, '大手スーパー運営企業でのシステム再構築プロジェクト', 1, 2, 3, 'PHP,詳細設計以降の経験', 650000, 'みなとみらい', '・大手スーパー運営中の企業で既存システムの刷新プロジェクトと、\r\n来年の稼働予定の物流センター向けのシステム構築の対応', 'ARアドバンストテクノロジ株式会社【略称：ARI】\r\nソリューション営業部\r\n首都圏第1グループ\r\n武田　一馬 （Mob: 090-1423-4822)\r\n\r\n &lt;&lt;渋谷オフィス&gt;&gt; 〒150-0002\r\n東京都渋谷区渋谷1-14-16　渋谷野村證券ビル8F\r\nTEL：03-6450-6080　FAX：03-6450-6088\r\nE-mail　kazuma.takeda@ari-jp.com\r\n', '==========================================================\r\n案  件：大手スーパー運営企業でのシステム再構築プロジェクト\r\n\r\n商　流：エンドユーザー様⇒ARI\r\n\r\n内　容：\r\n　　・大手スーパー運営中の企業で既存システムの刷新プロジェクトと、\r\n　　　来年の稼働予定の物流センター向けのシステム構築の対応\r\n　\r\nシステム：\r\n　・商品提案マスタ・マスタメンテナンスシステム　刷新　17/08～18/3\r\n　　　-LAMP(Laravel)にて社内開発　\r\n　　　-来年度(3/21)初期リリースを目指す\r\n　　　-現在要件定義・外部設計中\r\n\r\n\r\n必　須：\r\n　・PHPでの開発経験3年以上\r\n　・詳細設計以降の経験\r\n　・既存ソースを読み込み素早く仕様を把握できること\r\n　　※ドキュメントがあまり整備されていないため\r\n\r\n尚　可：\r\n　・Laravelを使用しての開発経験\r\n　・システム刷新における要件定義の経験\r\n\r\n　　\r\n期　間：即日～最長2018年3月\r\n場　所：みなとみらい\r\n募　集：5名\r\n単　価：MAX65万\r\n精　算：150h～190h\r\n面　談：1回\r\n==========================================================\r\n', '2017-10-31 15:39:44', 0),
(32, 'asdfasdfa', 1, 2, 3, 'asdf', 1231231, 'asdfasdfa', 'asdfasdfadfa', '123eqwfdasedfads', 'asfaeraerfasdf', '2017-10-31 15:39:44', 1),
(33, 'dfsdf', 1, 2, 3, '', 12341234, '', '', '', '', '2017-10-31 15:39:44', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_project_industry`
--
ALTER TABLE `mst_project_industry`
  ADD PRIMARY KEY (`mst_id`);

--
-- Indexes for table `mst_project_kind`
--
ALTER TABLE `mst_project_kind`
  ADD PRIMARY KEY (`mst_id`);

--
-- Indexes for table `mst_project_phase`
--
ALTER TABLE `mst_project_phase`
  ADD PRIMARY KEY (`mst_id`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`mst_user_id`);

--
-- Indexes for table `t_engineer`
--
ALTER TABLE `t_engineer`
  ADD PRIMARY KEY (`t_engineer_id`);

--
-- Indexes for table `t_project`
--
ALTER TABLE `t_project`
  ADD PRIMARY KEY (`t_project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_project_industry`
--
ALTER TABLE `mst_project_industry`
  MODIFY `mst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_project_kind`
--
ALTER TABLE `mst_project_kind`
  MODIFY `mst_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_project_phase`
--
ALTER TABLE `mst_project_phase`
  MODIFY `mst_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_engineer`
--
ALTER TABLE `t_engineer`
  MODIFY `t_engineer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '会員番号', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_project`
--
ALTER TABLE `t_project`
  MODIFY `t_project_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '案件番号', AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
