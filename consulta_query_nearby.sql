SELECT
    *,
    (6371 * ACOS(COS(RADIANS(- 27.200768)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(- 49.624018)) + SIN(RADIANS(- 27.200768)) * SIN(RADIANS(latitude)))) AS distance
FROM
    `properties`
WHERE
    (6371 * ACOS(COS(RADIANS(- 27.200768)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(- 49.624018)) + SIN(RADIANS(- 27.200768)) * SIN(RADIANS(latitude)))) < `range`;


-- ADAPTAR ESSA CONSULTA PARA BUSCAR OS ENDEREÇOS DE FORNECEDORES


use service_range_calculator;
desc addresses;
alter table addresses change column longitude longitude decimal(9,6);

SELECT 
    *,
    (6371 * ACOS(COS(RADIANS(-25.4487700)) * COS(RADIANS(`lat`)) * COS(RADIANS(`long`) - RADIANS(-49.30393000000000)) + SIN(RADIANS(-25.4487700)) * SIN(RADIANS(`lat`)))) AS distance
FROM
	suppliers_addresses sa
    inner join suppliers su on su.id = sa.suppliers_id and su.deleted_at is null
    inner join addresses ad on ad.id = sa.addresses_id and ad.deleted_at is null
where 
	sa.deleted_at is null 
	and (6371 * ACOS(COS(RADIANS(-25.4487700)) * COS(RADIANS(`lat`)) * COS(RADIANS(`long`) - RADIANS(-49.30393000000000)) + SIN(RADIANS(-25.4487700)) * SIN(RADIANS(lat)))) <= `su`.`range`;
