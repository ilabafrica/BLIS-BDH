ALTER TABLE `rejection_reasons` ADD `disabled` INT(1) NOT NULL AFTER `description`;
ALTER TABLE `rejection_phases` ADD `disabled` INT(1) NOT NULL AFTER `description`;

--
-- Dumping data for table `rejection_phases`
--

INSERT INTO `rejection_phases` (`rejection_phase_id`, `name`, `description`, `disabled`, `ts`) VALUES
(1, 'Pre-Analytical', 'Before Testing', 0, '2014-07-25 15:16:45'),
(2, 'Analytical', 'During Testing', 0, '2014-07-25 15:17:05'),
(3, 'Post-Analytical', 'After Testing', 0, '2014-07-25 15:17:22');

--
-- Dumping data for table `rejection_reasons`
--

INSERT INTO `rejection_reasons` (`rejection_reason_id`, `rejection_phase`, `rejection_code`, `description`, `disabled`, `ts`) VALUES
(1, 2, '001', 'Poorly labelled', 0, '2014-07-25 15:26:17'),
(2, 2, '002', 'Over saturation', 0, '2014-07-25 15:26:41'),
(3, 2, '003', 'Insufficient Sample', 0, '2014-07-25 15:27:04'),
(4, 2, '004', 'Scattered', 0, '2014-07-25 15:27:25'),
(5, 1, '005', 'Clotted Blood', 0, '2014-07-25 15:27:43'),
(6, 2, '006', 'Two layered spots', 0, '2014-07-25 15:27:58'),
(7, 2, '007', 'Serum rings', 0, '2014-07-25 15:28:16'),
(8, 1, '008', 'Scratched', 0, '2014-07-25 15:28:34'),
(9, 1, '009', 'Haemolysis', 0, '2014-07-25 15:28:48'),
(10, 2, '010', 'Spots that cannot elute', 0, '2014-07-25 15:29:07'),
(11, 2, '011', 'Leaking', 0, '2014-07-25 15:29:27'),
(12, 1, '012', 'Broken Sample Container', 0, '2014-07-25 15:29:46'),
(13, 1, '013', 'Mismatched sample and form labelling', 0, '2014-07-25 15:30:02'),
(14, 1, '014', 'Missing Labels on container and tracking form', 0, '2014-07-25 15:30:21'),
(15, 1, '015', 'Empty Container', 0, '2014-07-25 15:30:41'),
(16, 1, '016', 'Samples without tracking forms', 0, '2014-07-25 15:31:03'),
(17, 1, '017', 'Poor transport', 0, '2014-07-25 15:31:28'),
(18, 2, '018', 'Lipaemic', 0, '2014-07-25 15:32:03'),
(19, 1, '019', 'Wrong container/Anticoagulant', 0, '2014-07-25 15:32:21'),
(20, 1, '020', 'Request form without samples', 0, '2014-07-25 15:32:37'),
(21, 1, '021', 'Missing collection date on specimen / request form.', 0, '2014-07-25 15:32:57'),
(22, 1, '022', 'Name and signature of requester missing', 0, '2014-07-25 15:33:15'),
(23, 1, '023', 'Mismatched information on request form and specimen container.', 0, '2014-07-25 15:33:53'),
(24, 1, '024', 'Request form contaminated with specimen', 0, '2014-07-25 15:34:13'),
(25, 1, '025', 'Duplicate specimen received', 0, '2014-07-25 15:34:32'),
(26, 1, '026', 'Delay between specimen collection and arrival in the laboratory', 0, '2014-07-25 15:34:56'),
(27, 1, '027', 'Inappropriate specimen packing', 0, '2014-07-25 15:35:18'),
(28, 2, '028', 'Inappropriate specimen for the test', 0, '2014-07-25 15:35:46'),
(29, 2, '029', 'Inappropriate test for the clinical condition', 0, '2014-07-25 15:36:06'),
(30, 1, '030', 'No Label', 0, '2014-07-25 15:46:39'),
(31, 1, '031', 'Leaking', 0, '2014-07-25 15:46:57'),
(32, 2, '032', 'No Sample in the Container', 0, '2014-07-25 15:47:15'),
(33, 1, '033', 'No Request Form', 0, '2014-07-25 15:47:37'),
(34, 1, '034', 'Missing Information Required', 0, '2014-07-25 15:47:59');
