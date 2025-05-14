
# 📦 Deployment Procedure for RapportNav 1

## 🛠️ Preparation

1. **Place deployment scripts**  
   Copy the following files to the **root directory** of the project:
  - `creerZipProd.sh`
  - `deployer.sh`

2. **Update version number**  
   Edit the file `creerZipProd.sh` and update the `VERSION` variable with the new version number.

3. **Prepare parameters file**  
   Copy the template configuration file:

   ```bash
   cp assets/template.params.json assets/params.json
   ```

   Then, insert the correct **API URLs** for:
  - `navire`
  - `natinfs`

4. **Update version in Symfony config**  
   Edit `config/services.yaml` and update the `app.version` variable accordingly.

5. **Ensure environment configuration**  
   Verify that the `.prod.env.local` file exists at the root of the project.  
   ⚠️ **This file is required.**

## 🧰 Create the Production Archive

Run the following script to generate a zip archive of the project:

```bash
./creerZipProd.sh
```

This will package the project into a `.zip` file for deployment.

## 🚀 Send the Archive to the IT Team (DSI)

Choose one of the following methods:

- 📤 **Via WeTransfer**, or
- 📁 **Direct upload to the VM** under:

  ```
  U:/Echanges/RPN
  ```

  > If the folder `RPN` does not exist, you may create it.

## 📂 Deployment on the DSI Server


  ***Server Name*** : eig-ciblage


1. **Transfer and unzip**  
   Move the zip file to the server directory:

   ```
   /opt/app/rapportMission
   ```

   Unzip the archive there.

2. **Run deployment script**

   ```bash
   ./deployer.sh
   ```

3. **Set permissions**  
   Apply full permissions to the following directories:

   ```bash
   chmod -R 777 /opt/app/rapportMission/src
   chmod -R 777 /opt/app/rapportMission/public
   ```

## ✅ Post-Deployment Checks

- Verify that the application works as expected.
- Pay special attention to the **export functionality**.

## ❗ In Case of SQL Migration Errors

If an error occurs during `deployer.sh` related to SQL migrations:

1. Run:

   ```bash
   php bin/console doctrine:schema:update --dump-sql
   ```

2. If it outputs pending changes, apply them with:

   ```bash
   php bin/console doctrine:schema:update --force
   ```

## 💻 System Requirements for Packaging Machine

Ensure that the machine running the packaging (`creerZipProd.sh`) has the following installed:

- `yarn`
- `PHP 7.4`
- `composer`
