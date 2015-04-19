SELECT
  `blog_post`.`post_id`,
  `blog_post`.`title`,
  `blog_post`.`body`,
  `blog_post`.`category`,
  `blog_post`.`created`,
  `blog_post`.`created_by`
FROM
  `blog_post`
WHERE
  `blog_post`.`post_id` = ?
