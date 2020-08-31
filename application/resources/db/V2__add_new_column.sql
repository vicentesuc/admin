alter table sgc_reporte_lista
    add column if not exists type enum ('local','rest') default 'local'

alter table sgc_cartera add column  if not exists  code_procesal bigint default  0;