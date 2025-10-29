-- Database Backup - Generated on 2025-10-29 01:44:35

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `tblassessment_levels`;
CREATE TABLE `tblassessment_levels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoryId` int DEFAULT NULL,
  `assessmentClass` text,
  `overValue` int DEFAULT NULL,
  `notOverValue` int DEFAULT NULL,
  `assessmentLevel` int DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblassessment_levels` (`id`, `categoryId`, `assessmentClass`, `overValue`, `notOverValue`, `assessmentLevel`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES ('1', '2', 'Residential', '0', '175000', '0', '', '2025-10-29 01:08:00', '2025-10-29 01:08:00', NULL, '1');
INSERT INTO `tblassessment_levels` (`id`, `categoryId`, `assessmentClass`, `overValue`, `notOverValue`, `assessmentLevel`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES ('2', '2', 'Residential', '175000', '300000', '10', '', '2025-10-29 01:08:29', '2025-10-29 01:08:29', NULL, '1');
INSERT INTO `tblassessment_levels` (`id`, `categoryId`, `assessmentClass`, `overValue`, `notOverValue`, `assessmentLevel`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES ('3', '2', 'Residential', '300000', '500000', '20', '', '2025-10-29 01:08:50', '2025-10-29 01:08:50', NULL, '1');

DROP TABLE IF EXISTS `tblassessment_requests`;
CREATE TABLE `tblassessment_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `arpNo` varchar(50) DEFAULT NULL,
  `pin` varchar(50) DEFAULT NULL,
  `assessmentLevelId` int DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  `ownerName` text,
  `marriedTo` text,
  `ownerAddress` text,
  `contactNo` int DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `adminName` text,
  `adminMarriedTo` text,
  `adminAddress` text,
  `adminContactNo` int DEFAULT NULL,
  `adminTin` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `municipality` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `octTctCloaNo` varchar(50) DEFAULT NULL,
  `surveyNo` varchar(50) DEFAULT NULL,
  `lotNo` varchar(50) DEFAULT NULL,
  `areaNo` varchar(50) DEFAULT NULL,
  `generalDescription` text,
  `structuralChecklist` text,
  `additionalItems` text,
  `propertyAppraisal` text,
  `propertyBounderies` text,
  `landAppraisal` text,
  `otherImprovements` text,
  `propertyAssessment` text,
  `appraisedBy` int DEFAULT NULL,
  `recommendingApproval` int DEFAULT NULL,
  `approvedBy` int DEFAULT NULL,
  `appraisedDate` varchar(50) DEFAULT NULL,
  `recommendDate` varchar(50) DEFAULT NULL,
  `approvedDate` varchar(50) DEFAULT NULL,
  `memorada` text,
  `requestStatus` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblassessment_requests` (`id`, `arpNo`, `pin`, `assessmentLevelId`, `categoryId`, `ownerName`, `marriedTo`, `ownerAddress`, `contactNo`, `tin`, `adminName`, `adminMarriedTo`, `adminAddress`, `adminContactNo`, `adminTin`, `street`, `barangay`, `municipality`, `province`, `octTctCloaNo`, `surveyNo`, `lotNo`, `areaNo`, `generalDescription`, `structuralChecklist`, `additionalItems`, `propertyAppraisal`, `propertyBounderies`, `landAppraisal`, `otherImprovements`, `propertyAssessment`, `appraisedBy`, `recommendingApproval`, `approvedBy`, `appraisedDate`, `recommendDate`, `approvedDate`, `memorada`, `requestStatus`, `created_at`, `updated_at`, `deleted_at`) VALUES ('1', '213213213', '123123', NULL, NULL, 'asdasdasd', 'fdfdfd', 'sdasdasd', '2147483647', '', 'sadasdas', 'fdsfsfsd', 'sadasdasdasdasdasd', '0', '', 'asdasdas', 'BORLONGAN', 'DIPACULAO', 'AURORA', NULL, 'PSD-03-258733', '325-A-2', '778 sqm', '{\"kindOfBldg\":\"Commercial\",\"structuralType\":\"Mixed Concrete (Lodging House)\",\"bldgPermit\":\"\",\"dateIssued\":\"\",\"cct\":\"\",\"certificateCompletionIssuedOn\":\"\",\"certificateOccupancyIssuedOn\":\"\",\"dateConstructed\":\"\",\"dateOccupied\":\"\",\"bldgAge\":0,\"noOfStoreys\":2,\"area1st\":52.1,\"area2nd\":47,\"area3rd\":0,\"area4th\":0,\"totalFloorArea\":99.1}', '{\"Roof\":[],\"Flooring\":[],\"WallsPartions\":[]}', '[]', '{\"unit\":\"sqm\",\"unitCost\":4380,\"computation\":\"\",\"subTotal\":0}', '{\"north\":\"\",\"east\":\"\",\"west\":\"\",\"south\":\"\"}', '[]', '[]', '{\"taxable\":true,\"exempt\":false,\"effectivity\":\"\",\"values\":[{\"actualUse\":\"COMMERCIAL\",\"marketValue\":434060,\"assessmentLevel\":35,\"assessedValue\":151920}]}', NULL, NULL, NULL, NULL, NULL, NULL, 'Declared new', NULL, '2025-10-29 01:28:08', '2025-10-29 01:28:20', NULL);

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE `tblcategory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblcategory` (`id`, `name`, `type`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES ('1', 'Commercial and Industrial', 'market', '1', '2025-10-29 00:57:22', '2025-10-29 00:57:22', NULL);
INSERT INTO `tblcategory` (`id`, `name`, `type`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES ('2', 'On Building and Other Structures', 'assessment', '1', '2025-10-29 01:07:26', '2025-10-29 01:07:26', NULL);

DROP TABLE IF EXISTS `tblmarket_values`;
CREATE TABLE `tblmarket_values` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoryId` int DEFAULT NULL,
  `municipality` text,
  `kindOfLand` text,
  `categoryClass` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `marketValue` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblmarket_values` (`id`, `categoryId`, `municipality`, `kindOfLand`, `categoryClass`, `unit`, `marketValue`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES ('1', '1', 'BALER', '', '1st', '', '7000', '2025-10-29 01:00:22', '2025-10-29 01:00:22', NULL, '1');

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE `tblusers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Student Number',
  `password` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `userType` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `isDeleted` int NOT NULL DEFAULT '0',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblusers` (`id`, `username`, `password`, `firstName`, `lastName`, `middleName`, `suffix`, `sex`, `email`, `contact`, `address`, `userType`, `status`, `isDeleted`, `createdAt`, `updatedAt`) VALUES ('1', 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Firsts', 'Users', 'Admin', ' ', 'Male', 'test@mail.com', '09876543212', 'test address', '1', '1', '0', '2024-10-12 22:35:21', '2024-10-12 22:35:21');

DROP TABLE IF EXISTS `tblusertypes`;
CREATE TABLE `tblusertypes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `modules` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tblusertypes` (`id`, `description`, `modules`) VALUES ('1', 'Super Admin', '101,102');
INSERT INTO `tblusertypes` (`id`, `description`, `modules`) VALUES ('2', 'Coordinator', '201,202');


SET FOREIGN_KEY_CHECKS=1;
