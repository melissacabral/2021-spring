#Get all the users that are admins
SELECT * 
FROM users
WHERE is_admin = 1

# get all the published posts that have comments turned off
SELECT * 
FROM posts
WHERE is_published = 1 
AND allow_comments = 0 

# get all posts containing the word 'thursday' in the body. % is a wildcard for multiple characters
SELECT * 
FROM posts
WHERE body LIKE '%Thursday%'
OR title LIKE '%Thursday%'

#get 20 published posts, newest first
SELECT date, title, post_id 
FROM posts
WHERE is_published = 1
ORDER BY date ASC
LIMIT 20

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
AND posts.is_published = 1

#Get the  usernames and profile pictures of 10 users that commented recently, and the titles of the posts they were commenting on
SELECT users.username, users.profile_pic, posts.title, comments.date, comments.body
FROM users, posts, comments
WHERE users.user_id = comments.user_id
AND posts.post_id = comments.post_id
LIMIT 10

#Add a new post
INSERT INTO posts
(image, title, category_id, body, date, user_id, allow_comments, is_published)
VALUES
('https://picsum.photos/id/1/200/300', 'Person sittin\' at a laptop', 2, 'this is the body', NOW(), 1, 0, 1 )

#add a few new users at once
INSERT INTO users
(username, email, password, is_admin, bio)
VALUES
('Tim Gomez', 'timgomez@example.com', 'password', 0, ''),
('Pat Wallace', 'patwallace@example.com', 'password', 0, ''),
('Kathryn Howell', 'kathryn@example.com', 'password', 0, '')

#search for the keyword "lorem" in published posts
SELECT post_id, title, body, is_published
FROM posts
WHERE ( title LIKE '%lorem%'
OR body LIKE '%lorem%'
OR image LIKE '%lorem%' )
AND is_published = 1