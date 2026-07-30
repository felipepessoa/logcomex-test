import { createActionWithMethods } from "../../../";
export const ExpensesController = {
    import: createActionWithMethods([
        { method: "post", url: "api/expenses/import" },
    ]),
    index: createActionWithMethods([{ method: "get", url: "api/expenses" }]),
} as const;
export namespace ExpensesController {
    export namespace _import {
        export type Request = App.Data.ImportExpenseRequestData;
        export type Response = object;
    }
    export namespace index {
        export type Request = App.Data.ExpenseRequestFilterData;
        export type Response = object;
    }
}
