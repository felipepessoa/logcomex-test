import type {ExpenseCollection, ExpenseFilters} from "../types";
import {request, uploadRoute} from "./client.ts";
import {ExpensesController} from "../generated/controllers/App/Http/Controllers";


export function importExpenses(file: File): Promise<ExpenseCollection> {
    const formData = new FormData();
    formData.append("file", file);
    return uploadRoute<ExpenseCollection>(ExpensesController.import(), formData);
}

export function listExpenses(filters: ExpenseFilters = {}): Promise<ExpenseCollection> {
   return request<ExpenseCollection>(ExpensesController.index({
       query: {
           collaborator: filters.collaborator ?? undefined,
           cnpj: filters.cnpj ?? undefined,
           merchant: filters.merchant ?? undefined,
           category: filters.category,
       }
   }))
}