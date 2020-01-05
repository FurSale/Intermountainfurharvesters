-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2020 at 02:04 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intermountain_fur`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) NOT NULL,
  `seller_item_id` int(11) NOT NULL,
  `bid_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bid_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unconfirmed',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `seller_item_id` (`seller_item_id`),
  KEY `buyer_id` (`buyer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `buyer_id`, `seller_item_id`, `bid_amount`, `bid_status`, `date_created`) VALUES
(1, 1, 1, '18.00', 'Confirmed', '2019-11-13 18:09:21'),
(3, 1, 3, '50.00', 'Confirmed', '2019-12-18 04:10:31'),
(4, 1, 5, '214.00', 'Confirmed', '2019-12-18 04:17:19'),
(6, 1, 8, '234.00', 'Unconfirmed', '2019-12-15 02:31:30'),
(7, 1, 9, '22.00', 'Confirmed', '2019-12-20 02:31:34'),
(16, 2, 1, '22.00', 'Confirmed', '2019-12-21 06:14:47'),
(17, 2, 9, '101.00', 'Confirmed', '2019-12-21 06:15:13'),
(18, 2, 3, '50.00', 'Confirmed', '2019-12-21 06:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE IF NOT EXISTS `buyer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission` decimal(12,2) NOT NULL,
  `fur_buyer_license_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_last_logged_in` timestamp NULL DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`id`, `first_name`, `last_name`, `company_name`, `address_1`, `address_2`, `city`, `state`, `zip`, `phone`, `email`, `commission`, `fur_buyer_license_num`, `date_last_logged_in`, `date_created`) VALUES
(1, 'firstttttttttttttttt', 'last', 'comapny', 'address1', 'address2', 'city', 'ID', '83814', '1243213234', 'test@test.com', '2.00', '131313123', NULL, '2019-11-17 17:55:37'),
(2, 'gfkdlda', 'jkfdla', 'gjdfkajhg', 'fjkahjk', '', 'ajgkdfal', 'CT', '777777', '77777777', 'agg@gamil.om', '2.00', 'lgjfkdljd', NULL, '2019-12-21 18:46:57'),
(3, 'gfdgdfg', 'fgreagt', 'gdffgad', 'hghgsf', 'h', 'hgfs', 'CA', '0009999', '44444444', 'g@gmail.com', '2.00', 'ddaada', NULL, '2019-12-21 18:47:51'),
(4, 'gre', 'fff', 'hat', 'trtyjuy', '', 'yhgj', 'DC', '66666', '3333333`', 'rr@ggg.com', '2.00', 'ggfshahtat', NULL, '2019-12-21 18:48:57'),
(5, 'jhgdjhgd', 'jytehki', 'trytr``', 'jhdaaa', '', 'jhgdj', 'DE', '55553', '66666666', 'g@d.com', '2.00', 'ghgjgd', NULL, '2019-12-21 18:50:00'),
(6, 'htywtfs', 'gswet5', 'sywyhda', 'lkhjfkhj', 'jf', 'adfjkad', 'CT', '44444', 'jhhjyys`', 'hfhf@bb.com', '2.00', 'fgfghtwrrq', NULL, '2019-12-21 18:50:55'),
(7, 'fhdayfaui;k', 'fjad;vhjaefio', 'jfkdalgjfagyu', 'hadjkhgajk', '', 'ghfao[f89a[', 'AK', '0009090', '7777777779', 'j@v.com', '2.00', 'fjkdalkfjalj', NULL, '2019-12-21 18:51:50'),
(8, 'gkyuyr`', 'gdh5w`1', '3333', 'gsgs', '', 'htgs', 'DE', '55555', '222222222', 'n@g.com', '2.00', 'gfsgsf', NULL, '2019-12-21 18:53:13'),
(9, 'tgsxbgs', 'tthtr', 'gsrrqq', 'gjdhsdhd', 'gdndhg', 'gaa', 'AZ', '66666', 'r5555555', 'y@g.com', '2.00', 'ghfshs', NULL, '2019-12-21 18:54:07'),
(10, 'sfghsgfs', 'ddd', 'gfssh', 'gfdg', '', 'hgsfs', 'CT', '44444', 'd4444444444``', 'g@gmail.com', '2.00', 'bvcbxbx', NULL, '2019-12-21 18:55:07'),
(11, 'vvv', 'zzzz', 'fagaa', 'wwwwwwww', '', 'wwwwww', 'CO', '666666666', '22222222', 'g@gmail.com', '2.00', 'gsfsgfs', NULL, '2019-12-21 18:55:59'),
(12, 'rrrrrrrr', 'ffffffff', '555555', 'rrrrrrr', 'ttttttt', 'ttttt', 'CT', '55555555', '444444444```', 'g@gmail.com', '2.00', '444444444', NULL, '2019-12-21 18:57:01'),
(13, 'ttttt', 'gggg', '4444```', 'ggggggg', '', 'ff', 'CA', '444444', '4444444444', 'g@gmail.com', '2.00', 'rrrr', NULL, '2019-12-21 18:57:45'),
(14, '555555', 'hhhh', 'eeeee', 'gggg', '', 'gww', 'DE', '55555555', '44444445`', 'guguyu@gnma.com', '2.00', 'ttttt', NULL, '2019-12-21 18:58:28'),
(15, 'nfkdsvnsnmkf', 'gjrip49', '5940]gjsl', '', '', '', '', '', '', '', '2.00', 'it43]043]', NULL, '2019-12-21 21:00:58'),
(16, 'rlka', '', 'gklkvm\'l', '', '', '', '', '', '', '', '2.00', 'rkaepkrla;', NULL, '2019-12-21 21:01:06'),
(17, 'vfkld/', 'ngjeo', 'gfkdkjdl', 'jadh;.', '', 'fjkd/nvak', 'CO', '7898', '888888888', 'hfjka@jajf.com', '2.00', 'fjkdlld', NULL, '2019-12-21 21:02:53'),
(18, 'n mc ncj;', 'HRUE;Q4UHA/\'', 'jhfdk', 'FNKDLFK', '', 'GKD;A', 'DC', '789988', '78789P78', 'DNSKA@GM.COM', '2.00', '789t7q', NULL, '2019-12-21 21:03:43'),
(19, 'hfjadk;riaei', 'hfjak;nvj', 'hjdfafjak.', 'jgkdfal', 'vbma', 'bjda;k', 'DE', '90889', '787998989', '', '2.00', 'UGANDKA.', NULL, '2019-12-21 21:04:27'),
(20, 'fjd.vnfmakdri', 'nfjaorio', 'kfdava/', 'bmdv ndjai', 'jie;', 'VFAK', 'DC', '7898978', '78979789789', '', '2.00', 'ofgjfdlfal', NULL, '2019-12-21 21:05:16'),
(21, 'GRU39[HFDJA,', 'rehr', 'FJDAKGJDA;K', 'bvfndmnm.a', '', 'jf.ak', 'DC', '788989', '89788678', '', '2.00', 'GNRJ;EIR\'Q', NULL, '2019-12-21 21:05:50'),
(22, 'gdfjk/k', 'fjd/ksvn', 'gfjdakn', 'gfdakna', '', 'gfka/', 'DC', '7897989', 'fjakv', 'bndfjknfjad@gm.com', '2.00', 'hgrgjk', NULL, '2019-12-21 21:06:53'),
(23, 'vfjka;krie', 'vnjfkar8', 'nvfjan', 'njfdk.nvm.', '', 'hfjkdakj;', 'DC', '787878', '789789789', '', '2.00', 'fdklfka', NULL, '2019-12-21 21:07:25'),
(24, 'gjfkaj', 'vjfafj', 'vfji;tiriq;', 'vfdadvan', '', 'fjak', 'CT', '898979', '789789', '', '2.00', 'nfjda.ndjk', NULL, '2019-12-21 21:07:52'),
(25, 'uq3[rjda,vn', 'vnfj;r8t;ea', 'vdfjkanjadk.', 'nfdvnfam', '', 'gjreari', 'DC', '789788', 'vnjao', 'v@gm.com', '2.00', 'jkfdankaka', NULL, '2019-12-21 21:08:28'),
(26, 'uq3[rjda,vn', 'vnfj;r8t;ea', 'vdfjkanjadk.', 'nfdvnfam', '', 'gjreari', 'DC', '789788', 'vnjao', 'v@gm.com', '2.00', 'jkfdankaka', NULL, '2019-12-21 21:08:28'),
(27, 'fjdkla', 'grjeiap', 'ghuiep', 'fndk;jfke', '', 'ghja;', 'DC', '78989', '678878787', '', '2.00', 'fkl;jdk;', NULL, '2019-12-21 21:48:50'),
(28, 'hg', 'euwi', 'gfdnb', 'ghfjdhj', '', 'ghj;a', 'DE', '67888', '678887878', 'ndkaa@gm.com', '2.00', 'jfoerieo\'qqq\'', NULL, '2019-12-21 21:49:25'),
(29, 'gadjh', 'u[', '47yreua,', 'gjdka.', '', 'bgda,', 'DE', '67888', 'i7887677', '', '2.00', 'hfjdah;a', NULL, '2019-12-21 21:49:53'),
(30, 'bfdnmd', 'bgjei;', 'ryeu.nfdt', 'bfjkdfa', '', 'gbfjka;', 'DC', '784937839', '56372727', '', '2.00', 'gfdka;nfmda', NULL, '2019-12-21 21:50:19'),
(31, 'hfriqpi458ruj', 'gfjdter', 'fjkkbvda.kdi', 'gej;irueiq', 'grjq;', 'fgrjne;q', 'DC', '657345378', 'fjkel', '', '2.00', 'fjds;jfkshfjaskh', NULL, '2019-12-21 22:06:33'),
(32, 'ghe\'ora', 'fndjka', 'aaaaa', 'gjei;a', '', 'fgjrerbje.', 'DC', '6789', '536784', 'djlajl@gm.com', '9.00', 'fjbvdnajalaa', NULL, '2019-12-21 22:07:06'),
(33, 'fdjmbfehju', 'vbfhdsjlrfj', 'fuieqpu4i3p', 'gjdfafnadm,v dm.', '', 'gjekgnrjkjr/\'', 'DC', '57483957389', '7589753897583', 'vbdfjbdaj@ma.com', '2.00', 'fjdkajafhdajkfhdajfa', NULL, '2019-12-21 22:07:39'),
(34, 'fnjbfenje', 'gruqqq', 'ty3pqyuq`', 'ghjkngsk', '', 'grjeiwruth', 'DE', '67868', '56378', '', '2.00', '563785637856378`', NULL, '2019-12-21 22:08:28'),
(35, 'reuqpgheqjb', 'fhequerqp', 'fejfebq', 'hjlheq;ei', '', 'frhnn fdy', 'CT', '655665', '65375638', '', '2.00', 'heiheuirheuil', NULL, '2019-12-21 22:09:09'),
(36, 'bdfj', 'feu', 'yfhejfd', 'ejs', '', 'fueuoqr8', 'DC', '67878', '53789', '', '2.00', '5734897538975839759', NULL, '2019-12-21 22:09:32'),
(37, '34u3ijf', 'bfjl', 'ruieng', 'rhajfn', '', 'hfjak', 'DE', '67868', '74834787438', '', '2.00', 'jreotji9494', NULL, '2019-12-21 22:10:04'),
(38, 'geruw[', 'brheql', 'gfjae;je;4q', 'GJDFKAHJA;', '', 'fjs;', 'DE', '75843957893', '67878', '', '2.00', 'ghja;fnajkfnajk', NULL, '2019-12-21 22:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trapper_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission` decimal(12,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `trapper_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `state`, `zip`, `phone`, `email`, `commission`, `date_created`) VALUES
(1, '00001', 'testttt', 'testificate2', 'sdfsdf', 'fdsfsdfsd', 'Coeur d\' Alene', 'ID', '13321', '', '', '6.00', '2019-11-17 17:44:57'),
(2, '00002', 'test2', 'testificate2', 'sdfsdf', 'fdsfsdfsd', '324r32432', 'WA', '13321', '', '', '0.00', '2019-12-02 07:05:35'),
(3, '00003', 'test', 'test', '123231', '1321312', 'Spokane', 'WA', '21334', '2313124123', 'test@test.com', '0.00', '2019-12-02 07:16:34'),
(4, '00003', 'test', 'test', '123231', '1321312', 'Spokane', 'WA', '21334', '2313124123', 'test@test.com', '0.00', '2019-12-02 07:17:51'),
(5, '123-123-2132', 'Rob', 'Ryan', '111 JJJJ', '', 'Hayden', 'ID', '93915', '2023333333', 'RYAN@123223323.COM', '5.00', '2019-12-12 04:54:42'),
(6, '555555555', 'Bernie', 'Nelson', '4444 freman', '', 'Newport', 'ID', '444545', '2344444444', 'bn333@jjjj.com', '5.00', '2019-12-12 04:56:05'),
(7, '5555555', 'Lee', 'Bodda', '8888 abc', '', 'Athol', 'CO', '23333', '3334445555', 'leeb@666.vom', '6.00', '2019-12-12 04:57:23'),
(8, '1009900', 'Frank', 'Getsfrid', '2268 sunset  Rd', '', 'athol', 'ID', '83801', '2086593105', '6plotts@gmail.com', '6.00', '2019-12-12 17:15:33'),
(9, '10003', 'Sam', 'Man', '2268 sunset rd', '', 'Athol', 'ID', '83801', '2082155356', 'hhi@gmail.com', '6.00', '2019-12-14 16:29:35'),
(10, 'hhhhhhhhgyuygugy;', 'vyul', 'vggfrf', 'gyugyuout', '', 'cda', 'CO', '6666666', '(208)214-5456', 'guguyu@gnma.com', '6.00', '2019-12-21 18:28:04'),
(11, 'bbbbjk', 'bnnbnb', 'jkjk', 'hjhjgft', 'jgdfklgjdlajk', 'boise', 'ID', '555555', '(433)454-5444', 'hat@gmI.vom', '6.00', '2019-12-21 18:29:51'),
(12, 'bbbbjk', 'bnnbnb', 'jkjk', 'hjhjgft', 'jgdfklgjdlajk', 'boise', 'ID', '555555', '(433)454-5444', 'hat@gmI.vom', '6.00', '2019-12-21 18:29:51'),
(13, '1009900', 'Lee', 'Bodda', '2268 sunset  Rd', '', 'athol', 'ID', '83801', '2082155356', 'leebodda@gmail.com', '6.00', '2019-12-21 18:30:26'),
(14, 'jfkajdhjka', 'fjksdh', 'jak', 'ajkfldajl', 'fjlfda', 'mountain', 'ID', '44444', '(222)222-2222', 'guguyu@gnma.com', '6.00', '2019-12-21 18:31:33'),
(15, 'fhjjfkhjdj', 'dhfjdhfuwei', 'fhakvn', 'fjakdjf', '', 'jgkfdla', 'ID', '88888', '(222)222-2222', 'lee@ggg.com', '6.00', '2019-12-21 18:34:08'),
(16, '7777777', 'jgka;', 'hjghdfjal', 'fjsfgd', '', 'ghjaf', 'AL', '777777', '(777)777-7777', 'bc@gm.com', '6.00', '2019-12-21 18:34:53'),
(17, '88888888', 'fdjkakva;', 'uf\'i', 'fhjdahfaj\'', '', 'fhdjahf', 'CO', '77777', '(888)888-8888', 'k@gm.com', '6.00', '2019-12-21 19:08:40'),
(18, '888888888', 'fvhjkd;j', 'mcx,zm', 'hgfjadk;ad;', '', 'hfjoguf', 'AL', '8888888', '(888)888-8888', 'h@h.xpm', '6.00', '2019-12-21 19:10:10'),
(19, '8876667788909755', 'UUUU', 'RR', 'fhdalnnn', '', 'nb,mv,z', 'AK', '9999999999', '(999)999-9999', '7@hhh.com', '6.00', '2019-12-21 19:11:15'),
(20, '778787878', 'iiii', 'jjjj', 'hjfahja', '', 'hfadjfuoao\'', 'AK', '999898', '(888)888-8888', 'h@b.com', '6.00', '2019-12-21 19:12:10'),
(21, '5555555', '44dd', 'nnnnn', 'ppppppp', 'gfkdalvja', 'h', 'AK', '', '', 'h2@e.com', '6.00', '2019-12-21 19:41:16'),
(22, '5656565', 'ree', 'eee', 'ytytr', '', 'fdfd', 'AK', '99009978', '(555)666-5565', 'f@vni.com', '6.00', '2019-12-21 19:42:26'),
(23, '7767676', 'hose', 'gjae', '990900', '', 'hay', 'AK', '9876678', '(888)989-989', '89@gg.com', '6.00', '2019-12-21 19:48:40'),
(24, '66677899', 'John', 'hhehe', '9fg9a9', '', 'cda', 'AL', '787878', '(999)292-9292', 'h@gm.com', '6.00', '2019-12-21 20:29:20'),
(25, 'fdjahajkahfkadjhjla', 'fdhajfogr8', 'nm,vnzi;', 'ghadfjkdfj', '', 'ghadfjk;hj', 'AK', '998989', '(898)989-8989', '', '6.00', '2019-12-21 20:29:51'),
(26, 'gjdfal;fuiau/k3`', 'jgadn', 'bvnzmtj', 'hjvfkd.9okj', '', 'vnfjkdis', 'AK', '78098', '(767)564-466', '', '6.00', '2019-12-21 20:30:28'),
(27, 'ghjfadkdfjagrieoejrjffAKO', 'bkl;adal', 'nbam,cywq\'', 'fnadm,nga,', '', 'vndfamvhuek', 'AZ', '8778900', '(865)467-9097', '', '6.00', '2019-12-21 20:31:08'),
(28, 'nr9034909304930', 'ghdfhjfks', 'bnkzjrek;4j3', '8t4897987q[qn', '', 'erui;8rqa;o', 'AK', '0989788', '(787)878-2827', '', '6.00', '2019-12-21 20:31:42'),
(29, 'hfjdahg;qr[8q3[049', 'gruioerueo9', 'eru89yfh', 'fhsdjkvjda', '', 'ufhi;', 'AL', '688888', '(778)927-2282', '', '6.00', '2019-12-21 20:33:15'),
(30, '89898989', 'VFJDK;FUIGER\'O', 'FIGO;AVJNKA/L', 'FHADJGHERU\'OR8U', '', 'HFRO\'', 'CT', '998989', '(787)878-8877', 'JFAD/JAD@G.COM', '6.00', '2019-12-21 20:33:56'),
(31, '98887658979945', 'hgfja;yuer\'', 'hgf;iagufEI', 'jhfadhfjad', '', 'hfja\'dojfka\'', 'CT', '787888', '(867)848-4748', '', '6.00', '2019-12-21 20:35:03'),
(32, 'jkgjkfls\'jka\'l', 'jfkdljkgm', 'bnvm/kfivuer', 'jkfnvkbhjfra', '', 'jfdk;fj', 'AR', '898989', '(743)847-8374', '', '6.00', '2019-12-21 20:35:33'),
(33, '8497957847', 'gihaui;fhv', 'ghe;ruigru;iq', 'fhdl4u', '', 'fuida;hua;i', 'AK', '887765', '(767)682-2872', 'gee@gmail.com', '6.00', '2019-12-21 20:56:06'),
(34, '7489789378493', 'joe', 'blow', 'lbloe lane', '', 'fjj', 'AL', '898989', '(666)969-6969', '', '6.00', '2019-12-21 20:57:02'),
(35, '6787887867', 'hjjyuil', 'drth', '678oghl', 'q', 'jkk/', 'AL', '666564', '(678)767-6755', 'fff@gmail.com', '6.00', '2019-12-21 20:58:06'),
(36, '8498349038904', 'gfjdk', 'ruie[48]', 'jaio]', '', 'hfidoa[o8', 'AL', '89898', '(484)848-3473', 'gajhk@jgaj.com', '6.00', '2019-12-21 20:59:24'),
(37, 'hdfjkafa;jak', 'gfjadhgi', 'rjio\'JN', 'gjkoop', '', '', '', '', '(888)888-8000', 'gahdjk@gm.com', '6.00', '2019-12-21 21:00:06'),
(38, 'dnvxcmcnx,', 'vnmvnz', 'vfda.', 'vfdvfdja;', '', 'ji;er8i', 'AK', '898989', '(789)8', '', '6.00', '2019-12-21 21:10:39'),
(39, 'gjke\'jgrie\'ojrieq', 'g;nv nmvna', 'fjei485734o;;q/', 'fgndvnm.ejw;k', '', 'GFJADFJ', 'WV', '8978979', '(789)978-9898', '', '6.00', '2019-12-21 21:11:15'),
(40, 'GNKNMD,NF', 'bfksjfkla', 'vvfor84w', 'gfjdrue438493', '', 'fhvbzj', 'AL', '787878', '(898)989-8989', '', '6.00', '2019-12-21 21:31:39'),
(41, '678678768', 'fjkdvncm ', 'FHDJKAHVAJ', 'vdja,', '', 'rjaerfiueq\'', 'AL', '78989', '(786)676-7677', 'hfdsaksh@gm.com', '6.00', '2019-12-21 21:32:50'),
(42, '748974893378``', '8t9pwgh', 'ghis', 'hgj;a', '', 'gnjfa', 'AL', '768768', '(789)789-9989', 'gg@gam.com', '6.00', '2019-12-21 21:35:06'),
(43, 'gjkjak', 'bnfmdkfvdm', 'nfj', 'vnkvjna', '', 'bjdfklsd', 'AL', '67868', '(833)736-2527', '', '6.00', '2019-12-21 21:35:40'),
(44, 'rhjknfak', 'gnfkdnr', 'gnjkae;', 'gfbdjgbgfadjl', '', 'gbjdsdb', 'AL', '787878', '(789)879-8989', '', '6.00', '2019-12-21 21:37:30'),
(45, '789789897879789', 'fdvn', 'ghfji;rahu;', 'ha;ghgjfa', '', 'vfjkdal\'', 'AK', '78989', '(789)089-8899', 'dkaka@gm.com', '6.00', '2019-12-21 21:38:15'),
(46, 'dii8888', 'gnfda,', 'bvdfnl', 'ajbadnmb,n', '', 'vfjdfbhal', 'AL', '676666', '(678)708-8777', '', '6.00', '2019-12-21 21:38:54'),
(47, 'fdhjkakfhkfjkfhdjkhfdjkhdja', 'ghjdakjhfadk', 'ghjk;a', 'fjdkagnfja;k', '', 'gjnfk.d', 'AK', '787878', '(787)877-7777', '', '6.00', '2019-12-21 21:39:26'),
(48, 'nvdfnak', 'grjkeo\'ir\'o', 'hrio3t483\'o', 'dka;jg\'', 'NFJDK', 'NJDA\'/', 'AL', '878777', '(678)677-2626', '', '6.00', '2019-12-21 21:39:58'),
(49, '75834975834974389``', 'HJSDLDHJKL', 'hfj', 'jkshjfs;', '4uriea', 'vnfd;kdrui', 'AL', '78787', '(678)678-6876', '', '6.00', '2019-12-21 21:40:38'),
(50, 'jfkdlsjkdl;', 'gjklf;', 'dfnrbnem', '74389hvdjsvdfn', '', 'ghriae49', 'AL', '78787', '(676)767-6767', '', '6.00', '2019-12-21 21:41:09'),
(51, 'hfjkdhfjdkjh', 'da;a;dka;', 'cjxfj', 'hfjkaghaj', '', 'ghfjoad\'', 'AL', '67676', '(567)525-2446', 'gjfkdal@gmma.com', '6.00', '2019-12-21 21:41:47'),
(52, 'gdfjkhgajak', 'ghj;aa', 'bjkbgern', 'fbkbfa', '', 'fj;ej\'w', 'AL', '444343', '(563)635-1418', '', '6.00', '2019-12-21 21:42:16'),
(53, '53789374897829', 'ghfjghdf', '47euaifsdjn', 'ghuie84[3', '', 'gjfb', 'AZ', '565656', '(424)131-2143', 'g@gmail.com', '6.00', '2019-12-21 21:42:59'),
(54, 'ghdjakhfkdj', 'gfjk', '4rya', 'bvnmsj', '', 'jeija;a', 'AK', '54433455', '(537)236-7288', '', '6.00', '2019-12-21 21:43:29'),
(55, 'dfhjkvnkvkl', 'fja;rueqa', 'hru9hfdzjk', 'dfkbvfvndfi', '', 'j;afurair7r', 'AL', '565567', '(673)227-8638', '', '6.00', '2019-12-21 21:45:28'),
(56, '547746783', 'ghdfjka;ha', 'gajda', 'hgd;a;a', '', 'ghfjds', 'AK', '67800', '(567)838-3388', 'hghg@gm.com', '6.00', '2019-12-21 21:46:10'),
(57, 'gfjk;ah;gjka', 'ghd;fjkha\'', 'ghdfjvn', 'bnvbdfj;a', '', 'hfrua;ifna', 'AL', '678838', '(568)798-8999', '', '6.00', '2019-12-21 21:46:41'),
(58, 'fjkgljdkdfgjvnd', 'jrieo4q3]', 'vnfbvehi', 'hgjdhgdfjs', '', 'ghdfjs\'ri', 'AL', '838383', '(578)957-8397', 'vdfjkdjnk2@gm.com', '6.00', '2019-12-21 21:47:38'),
(59, 'nfdndkgf\'', 'fkoe\'rie\'o', 'gnjrrue\'o', 'ghfaohira\'o', '', 'grue;hrje', 'AL', '788888', '(673)383-2176', 'djkaad@gm.cm', '6.00', '2019-12-21 21:48:12'),
(60, 'eejklw;', 'nfka;', 'nd', 'fak.', '', 'faj', 'AL', '78788', '(788)789-789', '', '6.00', '2019-12-21 22:02:41'),
(61, '53478957389```', 'tyeighr', 'ghds', 'gbdjkl', '', 'vjdf', 'AL', '67878', '(578)397-8398', 'hdjka@gm.com', '6.00', '2019-12-21 22:04:26'),
(62, 'jrkek;q;', 'gdf.s', 'bdfn.', 'fhea', '', 'NFJ;', 'AL', '789999', '(678)787-8888', 'gkd@gm.com', '6.00', '2019-12-21 22:05:07'),
(63, 'gje;airj;qe', 'gej;i', 'rhuq[', 'tvdfksk', '', 'fjka.', 'AL', '678688', '(678)267-8723', '', '6.00', '2019-12-21 22:05:33'),
(64, 'fjea;ai;fjriaejieo', 'hge;ri', '4hje', 'gbbjnfdm', '', 'huqi;', 'AL', '7867688', '(678)229-1128', '', '6.00', '2019-12-21 22:06:01'),
(65, 'gdjafhajahjl', 'fhdjafb dfn', 'vdndjy', 'gyubaj', '', 'fhdjs', 'AL', '567367', '(543)784-7834', '', '6.00', '2019-12-21 22:20:01'),
(66, 'ry39rywui', 'fjeab', 'vfbda', 'gipep', '', 'gdda', 'AL', '78833', '(537)867-3847', 'fhd@gm.com', '6.00', '2019-12-21 22:20:38'),
(67, 'djk;aaaaaaaa', 't', 't', 'hhh', '', 'fhdjs', 'ID', '83835', '(474)747-4442', 'ght@gm.com', '6.00', '2019-12-21 22:21:25'),
(68, 'h7747', 'fhdayfau', 'fjk', 're78w', '', 'fg', 'AL', '777777', '(678)878-7878', '', '6.00', '2019-12-21 22:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `seller_item`
--

CREATE TABLE IF NOT EXISTS `seller_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `lot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_of_measure` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Count',
  `count` decimal(12,2) NOT NULL,
  `tag_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asking` decimal(12,2) NOT NULL DEFAULT '0.00',
  `origin_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bid_start` datetime NOT NULL,
  `bid_end` datetime NOT NULL,
  `sale_made` tinyint(1) NOT NULL DEFAULT '0',
  `sale_amount` decimal(12,2) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lot` (`lot`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_item`
--

INSERT INTO `seller_item` (`id`, `seller_id`, `lot`, `type`, `item`, `unit_of_measure`, `count`, `tag_id`, `asking`, `origin_state`, `bid_start`, `bid_end`, `sale_made`, `sale_amount`, `date_created`) VALUES
(1, 1, '1001', NULL, 'Artic Fox', 'Count', '10.00', '', '20.00', '', '2019-11-17 00:00:00', '2019-11-18 00:00:00', 0, NULL, '2019-11-17 18:08:51'),
(3, 1, '1002', NULL, 'Artic Fox', 'Count', '15.00', '', '50.00', '', '2019-11-17 00:00:00', '2019-11-18 00:00:00', 0, NULL, '2019-11-17 19:15:58'),
(4, 3, '10002', NULL, 'Badger', 'Count', '10.00', '10', '25.00', '', '2019-12-05 03:46:57', '2019-12-05 03:46:57', 0, NULL, '2019-12-05 03:46:57'),
(5, 3, '1003', NULL, 'Bear rug', 'Count', '23.00', '13', '123.00', '', '2019-12-05 03:49:29', '2019-12-05 03:49:29', 1, NULL, '2019-12-05 03:49:29'),
(6, 3, '2001', NULL, 'Beaver Darts', 'Count', '123123.00', '123', '12.00', '', '2019-12-05 03:49:29', '2019-12-05 03:49:29', 0, NULL, '2019-12-05 03:49:29'),
(7, 3, '3001', NULL, 'Beaver Tails', 'Count', '31231.00', '21312', '22.50', '', '2019-12-05 03:49:29', '2019-12-05 03:49:29', 0, NULL, '2019-12-05 03:49:29'),
(8, 3, '1004', NULL, 'Beaver Darts', 'Count', '224.00', '2423', '23.47', '', '2019-12-05 03:55:13', '2019-12-05 03:55:13', 0, NULL, '2019-12-05 03:55:13'),
(9, 1, '1005', NULL, 'Bear rug', 'Count', '1.00', '57655', '100.00', 'GA', '2019-12-10 04:02:09', '2019-12-10 04:02:09', 0, NULL, '2019-12-10 04:02:09'),
(10, 1, '1006', NULL, 'test', 'Count', '2.00', '12323', '5.00', 'ID', '2019-12-10 05:03:02', '2019-12-10 05:03:02', 1, NULL, '2019-12-10 05:03:02'),
(11, 2, '2423', NULL, 'Beaver Skulls', 'Count', '23.00', '2342fss', '20.00', 'DE', '2019-12-19 04:34:46', '2019-12-19 04:34:46', 0, NULL, '2019-12-19 04:34:46'),
(12, 2, '2423423', NULL, 'Bear Parts', 'Lbs', '24.00', '23432', '3.00', 'DC', '2019-12-19 04:34:46', '2019-12-19 04:34:46', 0, NULL, '2019-12-19 04:34:46'),
(13, 2, '23432423', NULL, 'Artic Fox', 'Count', '24.00', '1, 12, 123 ,12345', '23.00', 'FL', '2019-12-19 04:37:41', '2019-12-19 04:37:41', 0, NULL, '2019-12-19 04:37:41'),
(15, 3, '1075', NULL, 'Bobcat', 'Count', '10.00', '1235', '120000.00', 'WA', '2019-12-19 04:45:30', '2019-12-19 04:45:30', 0, NULL, '2019-12-19 04:45:30'),
(16, 3, '1007', NULL, 'test', 'ct', '1.00', NULL, '10.00', 'WA', '2019-12-21 03:50:15', '2019-12-21 03:50:15', 0, NULL, '2019-12-21 03:50:15'),
(17, 3, '1008', NULL, 'Earings', 'ct', '1.00', NULL, '18.00', 'ID', '2019-12-21 04:05:35', '2019-12-21 04:05:35', 0, NULL, '2019-12-21 04:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE IF NOT EXISTS `site_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `bid_cutoff_days` int(11) NOT NULL DEFAULT '7',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `site_name`, `timezone`, `bid_cutoff_days`) VALUES
(1, 'Test2', 'America/Los_Angeles', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_one_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'administrator',
  `date_last_logged_in` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `password_one_time`, `deletable`, `role`, `date_last_logged_in`, `date_created`) VALUES
(1, 'admin', '$2y$10$aFuHxhyY6PnrGjdCrQC5ZeFTatoFcGcM6iq.udEyja00rTE9u6WAS', NULL, 0, 'administrator', '2019-12-30 00:39:37', '2019-12-11 19:23:14'),
(2, '1', NULL, '141181', 1, 'buyer', '2019-12-21 06:16:34', '2019-12-17 03:41:37'),
(3, '2', NULL, '845781', 1, 'buyer', '2019-12-28 07:08:06', '2019-12-17 04:13:21'),
(6, '16', NULL, '986888', 1, 'buyer', NULL, '2020-01-05 02:03:05'),
(7, '37', NULL, '697542', 1, 'buyer', NULL, '2020-01-05 02:03:14');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seller_item`
--
ALTER TABLE `seller_item`
  ADD CONSTRAINT `fk_seller_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
