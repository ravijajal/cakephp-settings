CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;