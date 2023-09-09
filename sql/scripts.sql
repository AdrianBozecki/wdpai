

create table public.user_details
(
    id       serial
        primary key,
    name     varchar(200),
    lastname varchar(50),
    phone    varchar(50)
);

alter table public.user_details
    owner to dbuser;

create table public.users
(
    id              serial
        constraint user_pkey
            primary key,
    id_user_details integer
        unique
        constraint users_user_details_id_fk
            references public.user_details,
    email           varchar(50),
    password        varchar(50)
);

alter table public.users
    owner to dbuser;

create table public.meals
(
    id          serial
        primary key,
    id_user     integer
        constraint meals_users_id_fk
            references public.users,
    title       varchar(50),
    preparation varchar(3000),
    ingredients varchar(3000),
    created_at  date,
    "like"      integer,
    dislike     integer,
    category    varchar(50),
    image       varchar(200)
);

alter table public.meals
    owner to dbuser;



