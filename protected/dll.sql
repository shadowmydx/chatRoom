use chatroom;
grant select,update,insert on chatroom.* to chatuser@"%" identified by '123';

CREATE TABLE content (
	content_id integer auto_increment primary key, 
	content_author VARCHAR(100) default 'ÄäÃû',
	content_body text not null,
	content_date timestamp default current_timestamp
)auto_increment = 1;

CREATE VIEW max_key AS 
    SELECT COUNT(*) AS start
    FROM content;
