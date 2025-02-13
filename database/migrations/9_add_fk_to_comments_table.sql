alter table comments
    add application_id int not null;

alter table comments
    add constraint comments_applications_id_application_fk
        foreign key (application_id) references applications (id_application);

