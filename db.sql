create table `users`(
    `id` int auto_increment,
    `username` varchar(10) unique not null,
    `password` varchar(255) not null,
    `created_at` timestamp not null default current_timestamp,
    `updated_at` timestamp not null default current_timestamp,
    primary key (`id`)
);

create table books (
    `id` int auto_increment,
    `user_id` int not null,
    `title` varchar(255) not null,
    `author` varchar(255) not null,
    `genre` varchar(100),
    `published_year` int not null,
    `image_url` varchar(255),
    `created_at` timestamp default current_timestamp,
    `updated_at` timestamp default current_timestamp on update current_timestamp,
    primary key (`id`),
    foreign key (`user_id`) references `users`(`id`)
);

create table quotes (
    `id` int auto_increment,
    `user_id` int not null,
    `quote_text` text not null,
    `author` varchar(255) not null,
    `favorite` boolean not null default false,
    `created_at` timestamp default current_timestamp,
    `updated_at` timestamp default current_timestamp on update current_timestamp,
    primary key (`id`),
    foreign key (`user_id`) references `users`(`id`)
);

