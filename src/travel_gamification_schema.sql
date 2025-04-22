
DROP DATABASE IF EXISTS travel_gamification;
CREATE DATABASE travel_gamification;
USE travel_gamification;

CREATE TABLE Role (
  role_id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255),
  status VARCHAR(255)
);

CREATE TABLE User (
  user_id VARCHAR(255) PRIMARY KEY,
  username VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  avatar VARCHAR(255),
  description TEXT,
  user_rank VARCHAR(255),
  total_points INT,
  status VARCHAR(255),
  created_at DATETIME,
  role_id VARCHAR(255),
  FOREIGN KEY (role_id) REFERENCES Role(role_id)
);

CREATE TABLE Province (
  province_id VARCHAR(255) PRIMARY KEY,
  code VARCHAR(255),
  name VARCHAR(255),
  region VARCHAR(255)
);

CREATE TABLE District (
  district_id VARCHAR(255) PRIMARY KEY,
  code VARCHAR(255),
  name VARCHAR(255),
  province_id VARCHAR(255),
  FOREIGN KEY (province_id) REFERENCES Province(province_id)
);

CREATE TABLE Ward (
  ward_id VARCHAR(255) PRIMARY KEY,
  code VARCHAR(255),
  name VARCHAR(255),
  district_id VARCHAR(255),
  FOREIGN KEY (district_id) REFERENCES District(district_id)
);

CREATE TABLE TravelType (
  travel_type_id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255),
  status VARCHAR(255)
);

CREATE TABLE UtilityType (
  utility_type_id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255),
  status VARCHAR(255)
);

CREATE TABLE Destination (
  destination_id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255),
  price VARCHAR(255),
  description TEXT,
  address VARCHAR(255),
  latitude DECIMAL(10, 8),
  longitude DECIMAL(11, 8),
  image_url VARCHAR(255),
  status VARCHAR(255),
  travel_type_id VARCHAR(255),
  province_id VARCHAR(255),
  district_id VARCHAR(255),
  ward_id VARCHAR(255),
  FOREIGN KEY (travel_type_id) REFERENCES TravelType(travel_type_id),
  FOREIGN KEY (province_id) REFERENCES Province(province_id),
  FOREIGN KEY (district_id) REFERENCES District(district_id),
  FOREIGN KEY (ward_id) REFERENCES Ward(ward_id)
);

CREATE TABLE DestinationImage (
  image_id VARCHAR(255) PRIMARY KEY,
  destination_id VARCHAR(255),
  name VARCHAR(255),
  image_url VARCHAR(255),
  status VARCHAR(255),
  FOREIGN KEY (destination_id) REFERENCES Destination(destination_id)
);

CREATE TABLE TravelUtility (
  utility_id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255),
  price VARCHAR(255),
  address VARCHAR(255),
  latitude DECIMAL(10, 8),
  longitude DECIMAL(11, 8),
  distance DOUBLE,
  phonenumber VARCHAR(255),
  time VARCHAR(255),
  description TEXT,
  image VARCHAR(255),
  status VARCHAR(255),
  utility_type_id VARCHAR(255),
  province_id VARCHAR(255),
  district_id VARCHAR(255),
  ward_id VARCHAR(255),
  FOREIGN KEY (utility_type_id) REFERENCES UtilityType(utility_type_id),
  FOREIGN KEY (province_id) REFERENCES Province(province_id),
  FOREIGN KEY (district_id) REFERENCES District(district_id),
  FOREIGN KEY (ward_id) REFERENCES Ward(ward_id)
);

CREATE TABLE DestinationUtility (
  id VARCHAR(255) PRIMARY KEY,
  destination_id VARCHAR(255),
  utility_id VARCHAR(255),
  FOREIGN KEY (destination_id) REFERENCES Destination(destination_id),
  FOREIGN KEY (utility_id) REFERENCES TravelUtility(utility_id)
);

CREATE TABLE Post (
  post_id VARCHAR(255) PRIMARY KEY,
  user_id VARCHAR(255),
  destination_id VARCHAR(255),
  utility_id VARCHAR(255),
  title VARCHAR(255),
  content TEXT,
  destination_name VARCHAR(255),
  address VARCHAR(255),
  status VARCHAR(255),
  created_at DATETIME,
  average_rating FLOAT,
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (destination_id) REFERENCES Destination(destination_id),
  FOREIGN KEY (utility_id) REFERENCES TravelUtility(utility_id)
);

CREATE TABLE Rating (
  rating_id VARCHAR(255) PRIMARY KEY,
  post_id VARCHAR(255),
  user_id VARCHAR(255),
  score INT,
  created_at DATETIME,
  FOREIGN KEY (post_id) REFERENCES Post(post_id),
  FOREIGN KEY (user_id) REFERENCES User(user_id)
);

CREATE TABLE Comment (
  comment_id VARCHAR(255) PRIMARY KEY,
  user_id VARCHAR(255),
  post_id VARCHAR(255),
  destination_id VARCHAR(255),
  utility_id VARCHAR(255),
  parent_comment_id VARCHAR(255),
  content TEXT,
  status VARCHAR(255),
  created_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (post_id) REFERENCES Post(post_id),
  FOREIGN KEY (destination_id) REFERENCES Destination(destination_id),
  FOREIGN KEY (utility_id) REFERENCES TravelUtility(utility_id),
  FOREIGN KEY (parent_comment_id) REFERENCES Comment(comment_id)
);

CREATE TABLE `Like` (
  like_id VARCHAR(255) PRIMARY KEY,
  user_id VARCHAR(255),
  post_id VARCHAR(255),
  comment_id VARCHAR(255),
  created_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (post_id) REFERENCES Post(post_id),
  FOREIGN KEY (comment_id) REFERENCES Comment(comment_id)
);

CREATE TABLE PostShare (
  share_id VARCHAR(255) PRIMARY KEY,
  post_id VARCHAR(255),
  user_id VARCHAR(255),
  is_public BOOLEAN,
  status VARCHAR(255),
  shared_at DATETIME,
  FOREIGN KEY (post_id) REFERENCES Post(post_id),
  FOREIGN KEY (user_id) REFERENCES User(user_id)
);

CREATE TABLE Report (
  report_id VARCHAR(255) PRIMARY KEY,
  reporter_id VARCHAR(255),
  user_id VARCHAR(255),
  post_id VARCHAR(255),
  comment_id VARCHAR(255),
  reason TEXT,
  reported_at DATETIME,
  FOREIGN KEY (reporter_id) REFERENCES User(user_id),
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (post_id) REFERENCES Post(post_id),
  FOREIGN KEY (comment_id) REFERENCES Comment(comment_id)
);

CREATE TABLE Badge (
  badge_id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255),
  description TEXT,
  icon_url VARCHAR(255),
  status VARCHAR(255)
);

CREATE TABLE UserBadge (
  user_badge_id VARCHAR(255) PRIMARY KEY,
  user_id VARCHAR(255),
  badge_id VARCHAR(255),
  status VARCHAR(255),
  awarded_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (badge_id) REFERENCES Badge(badge_id)
);

CREATE TABLE Mission (
  mission_id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255),
  description TEXT,
  points_reward INT,
  badge_id VARCHAR(255),
  condition_type VARCHAR(255),
  condition_value INT,
  status VARCHAR(255),
  FOREIGN KEY (badge_id) REFERENCES Badge(badge_id)
);

CREATE TABLE UserMission (
  user_mission_id VARCHAR(255) PRIMARY KEY,
  user_id VARCHAR(255),
  mission_id VARCHAR(255),
  status VARCHAR(255),
  progress INT,
  is_completed BOOLEAN,
  completed_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (mission_id) REFERENCES Mission(mission_id)
);

CREATE TABLE UserFollow (
  follow_id VARCHAR(255) PRIMARY KEY,
  follower_id VARCHAR(255),
  following_id VARCHAR(255),
  followed_at DATETIME,
  FOREIGN KEY (follower_id) REFERENCES User(user_id),
  FOREIGN KEY (following_id) REFERENCES User(user_id)
);

CREATE TABLE Notification (
  notification_id VARCHAR(255) PRIMARY KEY,
  user_id VARCHAR(255),
  follow_id VARCHAR(255),
  like_id VARCHAR(255),
  share_id VARCHAR(255),
  comment_id VARCHAR(255),
  report_id VARCHAR(255),
  is_read BOOLEAN,
  created_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (follow_id) REFERENCES UserFollow(follow_id),
  FOREIGN KEY (like_id) REFERENCES `Like`(like_id),
  FOREIGN KEY (share_id) REFERENCES PostShare(share_id),
  FOREIGN KEY (comment_id) REFERENCES Comment(comment_id),
  FOREIGN KEY (report_id) REFERENCES Report(report_id)
);
