-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2018 at 06:57 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wander`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_title` text NOT NULL,
  `blog_type` text NOT NULL,
  `blog_picArray` text NOT NULL,
  `blog_added` datetime NOT NULL,
  `blog_content` mediumtext NOT NULL,
  `added_id` int(11) NOT NULL,
  `blog_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `blog_type`, `blog_picArray`, `blog_added`, `blog_content`, `added_id`, `blog_status`) VALUES
(1, 'Meeting our match: Buying 100 percent renewable energy', 'Life Experience', '', '2018-04-05 00:00:00', 'A little over a year ago, we announced that we were on track to purchase enough renewable energy to match all the electricity we consumed over the next year. We just completed the accounting for Googleâ€™s 2017 energy use and itâ€™s officialâ€”we met our goal. Googleâ€™s total purchase of energy from sources like wind and solar exceeded the amount of electricity used by our operations around the world, including offices and data centers.\r\n\r\n\r\nWhat do we mean by â€œmatchingâ€ renewable energy? Over the course of 2017, across the globe, for every kilowatt hour of electricity we consumed, we purchased a kilowatt hour of renewable energy from a wind or solar farm that was built specifically for Google. This makes us the first public Cloud, and company of our size, to have achieved this feat.\r\n\r\n\r\nToday, we have contracts to purchase three gigawatts (3GW) of output from renewable energy projects; no corporate purchaser buys more renewable energy than we do. To date, our renewable energy contracts have led to over $3 billion in new capital investment around the world.', 1, '0'),
(2, 'Coding for Conservation', 'Education', '', '2018-04-10 00:00:00', 'Working on the CS First team, I love finding ways to get more kids involved with computer science at a young age. Though when I was a kid growing up in Miami, I spent most of my time off computers and on the water, admiring the natural beauty of the surrounding beaches and mangrove forests.\r\n\r\nI focused my studies and spare time on the environment, and how we could protect and preserve the habitats and creatures that made my home so special. I didnâ€™t quite understand how coding and technology would further my goal of protecting the environment until I got to Google, where Iâ€™ve learned that computer science is actually a critical tool for conservation and sustainability.\r\n\r\nTo help more kids understand the connection between coding and the environment (and to celebrate Earth Day!) weâ€™re teaming up with World Wildlife Fund (WWF) to invite students in grades 4-8 to create their own Google logo. Using Scratch, a block-based programming language, students will learn basic coding and stretch their design skills as they express their own ideas for protecting the planet.\r\n\r\nTo get ready to create their logo, students can watch videos to learn computer science concepts like sequencing and loops, practice analytical thinking and use creative problem solving skills. Those concepts and skills are the building blocks for developing technology that organizations like WWF and Google use in their efforts to protect the planetâ€™s animals and natural environment. In fact, the themes of the logo activityâ€”Sustainability and Wild Animalsâ€” were chosen to reflect those efforts.\r\n\r\n', 1, '0'),
(5, 'Monet was here: Masterpieces and inspirations come to Google Arts & Culture', 'Culture', '', '2018-04-10 00:00:00', 'Art lovers and historians know that sometimes to comprehend the magnitude of an artwork, you need to see the world through the eyes of the artist and understand what inspired them. This is especially true of an artist as talented and beloved as Claude Monet, whose work many of us know but may not have considered in depth. To reveal these insights, the National Gallery London is opening a new exhibition entitled The Credit Suisse Exhibition: Monet and Architecture. This new show will open up a new window into Claude Monetâ€™s world through the cities and buildings that brought his masterpieces to life. \r\n\r\nAnd to mark the opening of the physical exhibition in London, you can now explore a selection of these works from the National Gallery, and see a stirring retrospective of Monetâ€™s paintings from 17 more museums around the world, online on Google Arts & Culture.\r\n\r\nWritten by curators from the National Gallery, the online exhibition will feature new original stories about Monet, with little-known details of his travels through London, Paris, Rouen and Venice. For example, records show that Monet loved beautiful cities, appreciated architecture, and had a surprisingly great affinity for fog. This can be seen in much of his work, such as where he depicted the view of the Charing Cross Bridge from his suite in the Savoy Hotel in London.', 1, '0'),
(6, 'Expanding our cloud network for a faster, more reliable experience between Australia and Southeast Asia', 'Education', '', '2018-04-10 00:00:00', 'Earlier this year, we announced that we are expanding our global infrastructure with new regions and subsea cables, advancing our ability to connect the world and serve our Cloud customers with the worldâ€™s largest network.\r\n\r\nToday, weâ€™re excited to announce our investment in the Japan-Guam-Australia (JGA) Cable System.  \r\n\r\nThis new addition to the Google submarine network family, combined with investments in the  Indigo, HK-G and SJC subsea cables, will give GCP users access to scalable, diverse capacity on the lowest latency routes via a constellation of cables forming a ring between the key markets of Hong Kong, Australia and Singapore. Our investment in these cables builds on our other APAC cable systems, namely Unity, Faster and PLCN, interconnecting the United States with Japan, Taiwan and Hong Kong.\r\n\r\nTaken together, these cable investments provide improved connectivity to GCPâ€™s five cloud regions across Asia and Australia (with more on the way), so that companies using GCP can serve their customers no matter where they are.\r\n\r\nThe JGA cable system will have two fiber pairs connecting Japan to Guam, and two fiber pairs connecting Guam to Sydney. This provides deeply scalable capacity to both our users and Google Cloud Platform customers. JGA is being co-built by NEC Corporation and Alcatel Submarine Networks. The JGA-South segment is being developed by a consortium of AARnet, Google, and RTI-C, while the JGA-North segment is a private cable being developed by RTI-C. Together, the segments will stretch 9500 km (or nearly 6000 miles).\r\n\r\nWhether weâ€™re delivering directions to Maps users, videos to YouTube viewers, or GCP services to businesses, we know a fast and reliable infrastructure makes all the difference. Thatâ€™s why we continue to invest in strategic routes, many of which require crossing oceans.', 1, '0'),
(9, 'A new public energy tool to reduce emissions', 'Environment', 'CXtGUFoShvaxW8k/Energy_.max-1000x1000.png,CXtGUFoShvaxW8k/moecc-ccap-emissions-trends-d.jpg,', '2018-04-15 00:00:00', 'Renewable energy, and the transition to a low-carbon future, has long been a priority for Google. However, there is still a long way to go toward the low-carbon future we envision.\r\n\r\n\r\nElectricity generation from fossil fuels accounts for about 45 percent of global carbon emissions yet useful and accessible information to guide the transition to clean energy is still needed. Now with satellite data, cutting-edge science and powerful cloud computing technology like Google Earth Engine, we can achieve an unprecedented understanding of our changing environment and use that to guide wiser decision-making.\r\n\r\n\r\nToday, the World Resources Institute (WRI) and Google, in partnership with leading global research institutions including Global Energy Observatory, KTH Royal Institute of Technology in Stockholm, and the University of Groningen, are releasing a global database of power plants. This database standardizes power sector information to encourage providers to adopt a common approach for reporting power plant featuresâ€”like location, fuel type, and emissionsâ€”in the future.\r\n\r\nDrawing from over 700 publicly available data sources, this database compiles information to cover 80 percent of globally installed electrical capacity from 168 countries, and includes capacity, generation rates, fuel type, ownership and location. Making this kind of information open and accessible to researchers and scientists can help reduce carbon emissions and increase energy access. Power capacity and generation indicators can be used to develop a more granular understanding of the emissions created from the electricity we use, and to develop pathways to decarbonize electricity supply.\r\n\r\n\r\nInformation about power plantsâ€”such as location and sizeâ€”can help researchers study emissions and air pollution at an international, national, and local scale. And, as a high-quality geospatial data source, it can also be used to augment remote sensing and enable machine learning analysis to discover a wide variety of important environmental insights. The data is now available in Earth Engine and WRIâ€™s Resource Watch, where it can be easily combined with other data to create new insights.\r\n\r\n\r\nUntil recently it wasn\'t possible to monitor the health of Earth\'s critical resources in both a globally consistent and locally relevant manner. Making global data openly available for researchers is a core mission of the Earth Outreach team. By working closely with on-the-ground partners we can put this data into the hands of those who can take action. With the increased visibility into the power sector that this database provides, we see the potential to make the transition to a low-carbon future happen even faster.', 1, '0'),
(10, '(Cerf)ing the Internet: meet the man who helped build it', 'Education', '1dQ3eA7HBpD0fgb/Vint_Cerf_Gallery5.max-1000x1000.jpg,', '2018-04-20 00:00:00', 'Tell us about the job that youâ€™ve set out to do at Google (as well as your unique title).\r\nWhen I first got the job at Google, I proposed to Larry and Sergey (Googleâ€™s founders) that my title should be â€œarchduke.â€ They countered with â€œChief Internet Evangelist,â€ and I was okay with that. My objective was, and still is, to get more internet out there. Google has been very effective in fulfilling that objective so far with CSquared and efforts for the Next Billion Users. But today only half the worldâ€™s population is online, and Iâ€™ve been told Iâ€™m not allowed to retire because my job is only half done.\r\n\r\nWhat are some other things youâ€™ve worked on at Google?\r\nIn my years at Google, Iâ€™ve had the lucky freedom to stick my nose into pretty much anything. Iâ€™ve gotten very interested in the internet of things, and want to foster a deep awareness of what it takes to make those devices work well, while preserving safety, security and privacy.\r\n\r\nSince my first day at Google, Iâ€™ve been passionate about making our products accessible to everyone, whether you have a hearing, vision or mobility problem (or something else). Iâ€™m hearing impairedâ€”Iâ€™ve worn a hearing aid since I was 13â€”and my wife is deaf but uses two cochlear implants. Google has an entire team in place that looks after accessibility across all of our product areas.\r\n\r\nOh, another project Iâ€™ve been working on is Digital Vellum, to address my concern about the fragility of digital information. We store our information on various media (think of the evolution of floppy disks to external hard drives to the cloud), but those media donâ€™t last forever. Sometimes the media is ok, but the reader doesnâ€™t work. To make matters worse, even if you can read the bits, if you donâ€™t have the software that know what the bits mean, itâ€™s a worthless pile of bits! Digital Vellum is creating an environment where we can preserve the meaning of digital information over long periods of time, measured in hundreds of years.\r\n\r\nThat sounds like a lot of work for one guy at Google!\r\nCompared to what a lot of people do, this isnâ€™t much.', 1, '0'),
(11, 'How Google autocomplete works in Search', 'Education', 'vMYSwth5WXkaBIc/img1.png,vMYSwth5WXkaBIc/img2.png,vMYSwth5WXkaBIc/img3.png,', '2018-04-23 00:00:00', 'Autocomplete is a feature within Google Search designed to make it faster to complete searches that youâ€™re beginning to type. In this postâ€”the second in a series that goes behind-the-scenes about Google Searchâ€”weâ€™ll explore when, where and how autocomplete works.\r\n\r\n[[[b]]]Using autocomplete[[[/b]]]\r\nAutocomplete is available most anywhere you find a Google search box, including the Google home page, the Google app for iOS and Android, the quick search box from within Android and the â€œOmniboxâ€ address bar within Chrome. Just begin typing, and youâ€™ll see predictions appear:\r\n\r\n[[[img]]]img1.png[[[/img]]]\r\n\r\nIn the example above, you can see that typing the letters â€œsan fâ€ brings up predictions such as â€œsan francisco weatherâ€ or â€œsan fernando mission,â€ making it easy to finish entering your search on these topics without typing all the letters.\r\n\r\nSometimes, weâ€™ll also help you complete individual words and phrases, as you type:\r\n\r\n[[[img]]]img2.png[[[/img]]]\r\n\r\nAutocomplete is especially useful for those using mobile devices, making it easy to complete a search on a small screen where typing can be hard. For both mobile and desktop users, itâ€™s a huge time saver all around. How much? Well:\r\n\r\n\r\nOn average, it reduces typing by about 25 percent\r\nCumulatively, we estimate it saves over 200 years of typing time per day. Yes, per day!\r\n[[[b]]]Predictions, not suggestions[[[/b]]]\r\nYouâ€™ll notice we call these autocomplete â€œpredictionsâ€ rather than â€œsuggestions,â€ and thereâ€™s a good reason for that. Autocomplete is designed to help people complete a search they were intending to do, not to suggest new types of searches to be performed. These are our best predictions of the query you were likely to continue entering.\r\nHow do we determine these predictions? We look at the real searches that happen on Google and show common and trending ones relevant to the characters that are entered and also related to your location and previous searches.\r\n\r\nThe predictions change in response to new characters being entered into the search box. For example, going from â€œsan fâ€ to â€œsan feâ€ causes the San Francisco-related predictions shown above to disappear, with those relating to San Fernando then appearing at the top of the list:\r\n\r\n[[[img]]]img3.png[[[/img]]]\r\n\r\nThat makes sense. It becomes clear from the additional letter that someone isnâ€™t doing a search that would relate to San Francisco, so the predictions change to something more relevant.', 1, '0'),
(12, 'Stay composed: hereâ€™s a quick rundown of the new Gmail', 'Education', 'nZCh84D1btIuvzw/Gmail1.png,nZCh84D1btIuvzw/Gmail2.png,nZCh84D1btIuvzw/Gmail3.png,', '2018-05-02 00:00:00', 'Email is a necessity for most of us. We use it to stay in touch with colleagues and friends, keep up with the latest news, manage to-dos at home or at workâ€”we just canâ€™t live without it. Today we announced major improvements to Gmail on the web to help people be more productive at work. Hereâ€™s a quick look at how the new Gmail can help you accomplish more from your inbox.\r\n\r\n[[[b]]]Do more without leaving your inbox[[[/b]]]\r\nGmailâ€™s new look helps you get more done. Click on attachmentsâ€”like photosâ€”without opening or scrolling through large conversations, use the new snooze button to put off emails that you just canâ€™t get to right now or easily access other apps you use often, like Google Calendar, Tasks (now available on Android and iOS) and Keep.\r\nGmail will also â€œnudgeâ€ you to follow up and respond to messages with quick reminders that appear next to your email messages to help make sure nothing slips through the cracks.\r\n[[[img]]]Gmail1.png[[[/img]]]\r\n\r\nNew features on mobile, like high-priority notifications, can notify you of important messages to help you stay focused without interruption. Plus, Gmail will start suggesting when to unsubscribe from newsletters or offers you no longer care about.\r\n[[[img]]]Gmail2.png[[[/img]]]\r\n\r\nAnd you might notice new warnings in Gmail that alert you when potentially risky email comes through.\r\n[[[img]]]Gmail3.png[[[/img]]]\r\n', 3, '0'),
(13, 'Introducing .app, a more secure home for apps on the web', 'Education', '', '2018-05-02 00:00:00', 'Today weâ€™re announcing .app, the newest top-level domain (TLD) from Google Registry.\r\n\r\nA TLD is the last part of a domain name, like .com in â€œwww.google.comâ€ or .google in â€œblog.googleâ€ (the site youâ€™re on right now). We created the .app TLD specifically for apps and app developers, with added security to help you showcase your apps to the world.\r\n\r\nEven if you spend your days working in the world of mobile apps, you can still benefit from a home on the web. With a memorable .app domain name, itâ€™s easy for people to find and learn more about your app. You can use your new domain as a landing page to share trustworthy download links, keep users up to date, and deep link to in-app content.\r\n\r\nA key benefit of the .app domain is that security is built inâ€”for you and your users. The big difference is that HTTPS is required to connect to all .app websites, helping protect against ad malware and tracking injection by ISPs, in addition to safeguarding against spying on open WiFi networks. Because .app will be the first TLD with enforced security made available for general registration, itâ€™s helping move the web to an HTTPS-everywhere future in a big way.\r\n\r\nStarting today at 9:00am PDT and through May 7, .app domains are available to register as part of our Early Access Program, where, for an additional fee, you can secure your desired domains ahead of general availability. And then beginning on May 8, .app domains will be available to the general public through your registrar of choice.\r\n\r\nJust visit get.app to see whoâ€™s already on .app and choose a registrar partner to begin registering your domain. We look forward to seeing where your new .app domain takes you!\r\n#android #tezu', 3, '0'),
(15, 'Investing in startups and the future of the Google Assistant', 'Education', '', '2018-05-02 00:00:00', 'Across all our developer platforms, from Android to Chrome to Actions on Google and more, we\'ve focused on fostering an open ecosystem where developers can build rich experiences for their users. Weâ€™ve continued this approach with the Google Assistant, providing tools for developers to create natural conversational experiences. Weâ€™re also working closely with device partners to create new surfaces for the Assistant. Developers have created a wide range of Actionsâ€”some practical, some inspirationalâ€”that help you get things done in new ways we couldnâ€™t have predicted just a few years ago, whether thatâ€™s helping you control your smart home, find subway times, or even helping you meditate.\r\n\r\nTo promote more of this creativity, we\'re opening a new investment program for early-stage startups that share our passion for the digital assistant ecosystem, helping to push new ideas forward and advance the possibilities of what digital assistants can do.\r\n\r\nThis new program will consist of several components:\r\n\r\nInvestment capital from Google to provide additional financial resources for the development, hiring, and management of these startups.\r\nAdvice from Google engineers, product managers, and design experts to share technical guidance and product development feedback.\r\nGoogle partnership programs that provide early access to upcoming features and tools so startups can bring their products to market as quickly as possible.\r\nAccess to the Google Cloud Platform, our suite of cloud computing services that run on the same infrastructure that we use for products like Google Search and YouTube.\r\nPromotional support through Google marketing channels to drive greater awareness for the features and functionality of these new applications.\r\nWeâ€™re welcoming companies across a diverse range of fields, including startups that are developing technologies that broaden the Assistantâ€™s set of features, or are building new hardware devices for digital assistants, or that focus on a particular industry such as travel, games, or hospitality. Weâ€™re sharing the first batch of investments and look forward to helping them succeed in the Assistant ecosystem:\r\nGoMoment: Creator of Ivy, a 24/7 concierge for hotel guests, capable of providing instant answers to common questions like \"Is there a happy hour at the bar tonight?\" or â€œCan I get a late checkout?â€ Anything requiring human expertise is sent to hotel staff and tracked for quick and reliable resolution. Ivy is used by leading hotels like Caesars Palace, Treasure Island and Hard Rock.\r\nEdwin: Your personal English tutor powered by AI. Edwin prepares students looking to take English as a foreign language tests, such as the â€œTest of English as a Foreign Languageâ€ (TOEFL). Edwin combines advanced AI technology with the expertise of professional English teachers to tailor every lesson to your individual needs, learning style and pace. \r\nBotSociety: You can say a million things in a billion different ways to voice assistants, so BotSociety created a tool that allows developers to design, prototype and user test voice interfaces. More than 30,000 developers worldwide have designed their voice assistant applications using Botsociety.\r\nPulse Labs: Helping voice application designers understand what their users want to do. With Pulse Labs, developers can test their applications with real people, quickly acquire in-depth insights, and use that feedback to refine the experience.\r\n#tezu', 3, '0');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comm_content` text NOT NULL,
  `comm_at` datetime NOT NULL,
  `comm_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comm_id`, `user_id`, `blog_id`, `comm_content`, `comm_at`, `comm_status`) VALUES
(4, 1, 16, 'heyyyyy', '2018-05-29 06:27:30', 0),
(5, 1, 16, 'heyyy 2', '2018-05-29 07:50:19', 0),
(7, 1, 16, 'heyy3', '2018-05-30 03:42:53', 0),
(8, 1, 16, 'rohit', '2018-05-30 03:44:20', 0),
(9, 1, 16, 'heyyy5', '2018-05-30 08:43:30', 0),
(10, 1, 16, 'sumit', '2018-05-30 08:50:48', 0),
(11, 1, 1, 'renew the energy', '2018-05-31 10:44:37', 0),
(12, 1, 13, 'home security', '2018-05-31 10:53:40', 0),
(13, 1, 15, 'hjgjjg', '2018-06-01 07:59:22', 0),
(14, 1, 10, 'Internet means freedom', '2018-06-04 09:01:14', 0),
(15, 1, 13, 'Tezpur University', '2018-06-05 10:29:53', 0),
(16, 1, 11, 'Google', '2018-06-06 10:55:49', 0),
(17, 1, 11, 'Google search', '2018-06-06 10:57:41', 0),
(18, 1, 11, 'Search', '2018-06-06 10:58:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `follow_ID` int(11) NOT NULL,
  `follower_ID` int(11) NOT NULL,
  `following_ID` int(11) NOT NULL,
  `follow_status` enum('0','1') NOT NULL,
  `followed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follow_ID`, `follower_ID`, `following_ID`, `follow_status`, `followed_at`) VALUES
(1, 1, 2, '0', '2018-05-11 12:13:32'),
(2, 2, 1, '0', '2018-04-12 07:24:35'),
(3, 3, 1, '0', '2018-05-18 05:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `like_at` datetime NOT NULL,
  `like_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`like_id`, `user_id`, `content_id`, `like_at`, `like_status`) VALUES
(12, 1, 15, '2018-06-04 11:45:30', '0'),
(14, 1, 13, '2018-06-05 10:28:51', '0'),
(15, 1, 13, '2018-06-05 11:46:27', '1'),
(16, 1, 10, '2018-06-05 11:47:24', '0'),
(17, 1, 14, '2018-06-05 11:47:30', '1'),
(18, 1, 11, '2018-06-06 10:54:52', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `sign_up_date` date NOT NULL,
  `activated` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `first_name`, `last_name`, `email`, `password`, `sign_up_date`, `activated`) VALUES
(1, 'rohitpaul23', 'Rohit', 'Paul', 'rohitpaul97@gmail.com', '074bc381f27256cefdb8a54bb209b427', '2018-03-29', '0'),
(2, 'pradumnya18', 'Pradumnya', 'Borah', 'pradumnyaborah66@gmail.com', 'eec77dad805de8a3655c6a9e895bec3c', '2018-04-17', '0'),
(3, 'raghudev21', 'Raghudev', 'Sahu', 'raghudev111@gmail.com', 'bb052c8f1c746e0bd789023ae58b5c1c', '2018-04-20', '0'),
(4, 'sumitpaul23', 'Sumit', 'Paul', 'sumit@gmail.com', 'd0c83842bdc752ba120ee4be4b1b4582', '2018-06-06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `usersdetails`
--

CREATE TABLE `usersdetails` (
  `user_id` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `profile_pic` text NOT NULL,
  `address` text NOT NULL,
  `bio` text NOT NULL,
  `anonymous` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersdetails`
--

INSERT INTO `usersdetails` (`user_id`, `DOB`, `profile_pic`, `address`, `bio`, `anonymous`) VALUES
(1, '1994-11-24', 'wvtKEY5z1oqXMA9 /IMG_20160418_230717.JPG', 'tinsukia', 'Studying In Tezpur University', '0'),
(4, '2018-06-13', '', 'tinsukia', '', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follow_ID`),
  ADD UNIQUE KEY `follow_ID` (`follow_ID`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `follow_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
