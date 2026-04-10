/*
  Warnings:

  - You are about to drop the column `usuarioId` on the `Tarefa` table. All the data in the column will be lost.
  - You are about to drop the `Usuario` table. If the table is not empty, all the data it contains will be lost.

*/
-- DropForeignKey
ALTER TABLE "Tarefa" DROP CONSTRAINT "Tarefa_usuarioId_fkey";

-- AlterTable
ALTER TABLE "Tarefa" DROP COLUMN "usuarioId";

-- DropTable
DROP TABLE "Usuario";
