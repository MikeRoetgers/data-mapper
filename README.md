# Simple Data Mapper

[![Build Status](https://travis-ci.org/MikeRoetgers/data-mapper.svg?branch=master)](https://travis-ci.org/MikeRoetgers/data-mapper)

A simple data mapper that can support you mapping entities to other formats like arrays or JSON and the other way around.

## Usage

```php
$data = '{"id": 1, "name": "Mike"}';

$mapper = new GenericMapper(new EntityAutoMapper(), '\\My\\Namespace\\TestEntity');
$entity = $mapper->mapJsonToEntity($data);

echo $entity->getId(); // 1
echo $entity->getName(); // Mike
```

The mapper can translate attribute names between the entity and other formats.

```php
$data = '{"user_id": 23, "user_name": "Jonathan"}';

$mapper = new GenericMapper(new EntityAutoMapper(), '\\My\\Namespace\\TestEntity', array('id' => 'user_id', 'name' => 'user_name'));
$entity = $mapper->mapJsonToEntity($data);

echo $entity->getId(); // 23
echo $entity->getName(); // Jonathan
```

## Requirements

The data mapper expects your entities to have setters and getters, e.g. $yourEntity->setName('Name') or $yourEntity->getName().