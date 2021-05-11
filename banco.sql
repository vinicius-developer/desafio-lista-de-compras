create schema if not exists `test-backend-vinicius`;

use `test-backend-vinicius`;

create table if not exists months (
    id_month tinyint unsigned primary key auto_increment,
    name varchar(30) not null
);

create table if not exists categories (
    id_category tinyint unsigned primary key auto_increment,
    name varchar(80) not null
);

create table if not exists list_items (
    id_list_items int unsigned primary key auto_increment,
    id_mouth tinyint unsigned not null,
    id_category tinyint unsigned not null,
    name_item varchar(80) not null,
    quantity mediumint not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

alter table list_items
    add constraint list_items_id_month_foreign
    foreign key (id_mouth) references months(id_month);

alter table list_items
    add constraint list_items_id_category_foreign
    foreign key (id_category) references categories(id_category);

insert months (
    name
) value ('Janeiro'),
        ('Fevereiro'),
        ('Março'),
        ('Abril'),
        ('Maio'),
        ('Junho'),
        ('Julho'),
        ('Agosto'),
        ('Setembro'),
        ('Outubro'),
        ('Novembro'),
        ('Dezembro');

insert categories(
    name
) values ('Alimentos'),
         ('Higiene'),
         ('Limpeza');