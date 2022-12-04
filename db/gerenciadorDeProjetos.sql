Gerenciador de projetos
- listar Clientes
- cadastrar Clientes
- atualizar  clientes
- remover clientes
- listagem de projetos
- cadastrar um projeto
- atualizar um projeto existente
- excluir projeto
- ver um projeto
- listagem de andamentos por projeto
- cadastro de andamentos
- atualização de andamentos
- exclusão de andamentos

--------------------- BD ---------------------
CREATE TABLE IF NOT EXISTS projects (
    id_projects int(10) unsigned auto_increment primary key,
    name varchar2(150) not null,
    description text,
    id_clients int(10) unsigned not null,
    id_clients_intermediary int(10) unsigned default null,
    creation_datetime datetime,
    deadline_date date,
    value decimal(19,6) default 0.000000
    value_observations text,
    project_observations text,
    is_active binary(1) DEFAULT b'1',
    INDEX idx_id_clients(id_clients),
    CONSTRAINT fk_clients FOREIGN KEY (id_clients)
        REFERENCES clients(id_clients)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_id_clients_itermediary(id_clients_intermediary),
    CONSTRAINT fk_clients_intermediary FOREIGN KEY (id_clients_intermediary)
        REFERENCES clients(id_clients_intermediary)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS project_updates(
 id_updates int(10) unsigned auto_increment primary key,
 id_projects int(10) unsigned not null,
 update_datetime datetime,
 description text,
 INDEX idx_id_projects(id_projects),
 CONSTRAINT fk_projects FOREIGN KEY (id_projects)
    REFERENCES projects(id_projects)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS clients (
    id_clients INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150) NOT NULL,
    is_active BINARY(1) DEFAULT b'1'
);
