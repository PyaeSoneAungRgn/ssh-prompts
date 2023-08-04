![Demo](https://res.cloudinary.com/pyaesoneaung/image/upload/v1690730841/opensources/ssh-prompts/demo.png)

# SSH Prompts

SSH account management cli tool developed with Laravel Prompts and Laravel Zero

## Global Installation

```bash
composer global require pyaesoneaung/ssh-prompts
ssh-prompts
```

## Local Installation

Download the `ssh-prompts` file from the [Release page](https://github.com/PyaeSoneAungRgn/ssh-prompts/releases)

```bash
cd /path/to/download/folder
chmod +x ssh-prompts
./ssh-prompts
```

## Usage

#### List all host

```bash
ssh-prompts hosts
```

#### Create a host

```bash
ssh-prompts create
```

#### Update a host

```bash
ssh-prompts edit
```

#### Update a host

```bash
ssh-prompts delete
```

## Security

I developed this project for personal use. SSH Prompts stores host information in the `~/.ssh-prompts/db_ssh_prompts.json` file. For enhanced security, you can delete this file using `ssh-prompts clean`. This deletes sensitive data from storage when needed.
