# 

# Install

### 1. Add repository sources into `composer.json` file in application root directory

```json
"repositories": [
        ...,
        {
            "type": "vcs",
            "url": "git@github.com:dp-bratislava/pkg-devices.git"
        },        
        {
            "type": "vcs",
            "url": "git@github.com:dp-bratislava/pkg-eav.git"
        },
        ...,
]
```

### 2. Install composer repositories

```bash
# install package
composer require dpb/pkg-devices
```

### 3. Run migrations

First it installs migrations for EAV package, then for devices package itself.

```bash
# publish migrations
artisan pkg-devices:install

# yes to create and run migrations
```

# WIP

# Package content

## Vehicle

| model          | desc                                                              |
| -------------- | ----------------------------------------------------------------- |
| Device        | List of device instances. Concrete devices                      |
| Device type   | Generic device type like bus, tram, etc.                         |
| Device model  | Specific device model with detailed parameters                   |
| Device groups | Generic tool to group devices                                    |
| Licence plates | List of lince plates and history of their assignments to devices |
