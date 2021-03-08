#Get all the users that are admins
SELECT * FROM users
WHERE is_admin = 1

# get all the published posts that have comments turned off
SELECT * 
FROM posts
WHERE is_published = 1 
AND allow_comments = 0 

# get all posts containing the word 'thursday' in the body. % is a wildcard for multiple characters
SELECT * FROM posts
WHERE body LIKE '%Thursday%'
OR title LIKE '%Thursday%'

#get all published posts, newest first
SELECT date, title, post_id FROM posts
WHERE is_published = 1
ORDER BY date ASC

#count how many posts are in each category
SELECT category_id, COUNT(*) AS total 
FROM posts
GROUP BY category_id

# JOIN practice! Get the titles of all posts and the username of their authors
SELECT posts.title, users.username
FROM posts, users
WHERE posts.user_id = users.user_id
      AND posts.is_published = 1
ORDER BY users.username ASC



# JOIN practice! Get the titles of all posts and the username of their authors and the name of the category each post is in
SELECT posts.title, users.username, categories.name
FROM posts, users, categories
WHERE posts.user_id = users.user_id
AND posts.category_id = categories.category_id

#Get the  usernames and profile pictures of all the users that commented recently, and the titles of the posts they were commenting on
SELECT users.username, users.profile_pic, posts.title, comments.date, comments.body
FROM users, posts, comments
WHERE users.user_id = comments.user_id
AND posts.post_id = comments.post_id


