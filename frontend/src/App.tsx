import {ExpenseUpload} from "./components/ExpenseUpload.tsx";
import {useCallback, useEffect, useState} from "react";
import type {Expense, ExpenseFilters} from "./types";
import {importExpenses, listExpenses} from "./api/expenses.ts";
import {ErrorMessage} from "./components/ui/ErrorMessage.tsx";
import {ExpenseTable} from "./components/ExpenseTable.tsx";

function ExpenseFilters(props: {
    filters: ExpenseFilters,
    onChange: (value: (((prevState: ExpenseFilters) => ExpenseFilters) | ExpenseFilters)) => void,
    onSearch: () => any,
    onClear: () => void,
    loading: boolean
}) {
    return null;
}

export default function App() {
    const [expenses, setExpenses] = useState<Expense[]>([]);
    const [importedExpenses, setImportedExpenses] = useState<Expense[]>([]);
    const [filters, setFilters] = useState<ExpenseFilters>({});
    const [loadingList, setLoadingList] = useState<boolean>(true);
    const [loadingUpload, setLoadingUpload] = useState<boolean>(false);
    const [error, setError] = useState<string | null>(null);

    const loadExpenses = useCallback( async (currentFilters: ExpenseFilters = filters) => {
        setLoadingList(true);
        setError(null);
        try{
            const response = await  listExpenses(currentFilters);
            // @ts-ignore
            setExpenses(response?.expenses ?? []);
        } catch (error) {
            setError("Erro ao carregar despesas.");
        } finally {
            setLoadingList(false);
        }
    }, [filters]);
    useEffect(() => {
        loadExpenses();
    }, [loadExpenses]);

    const handleUpload = async (file: File) => {
        setLoadingUpload(true)
        setError(null);
        setImportedExpenses([]);
        try{
            const response = await  importExpenses(file);
            // @ts-ignore
            setImportedExpenses(response.expenses ?? []);
            await loadExpenses();
        }catch(error){
            setError('Erro ao importar despesas.');
        } finally {
            setLoadingUpload(false);
        }
    }

    const handleClearFilters = () => {
        setFilters({});
        void loadExpenses({});
    }

    return (
        <div className="min-h-screen bg-gray-50">
            <header className="border-b border-gray-200 bg-white">
                <div className="mx-auto max-w-7xl px-4 py-6">
                    <h1 className="text-2xl font-bold text-gray-900">
                        Logcomex — Importação de Despesas
                    </h1>
                    <p className="mt-1 text-sm text-gray-600">
                        Envie um PDF escaneado para extrair e importar despesas.
                    </p>
                </div>
            </header>
            <main className="mx-auto flex max-w-7xl flex-col gap-6 px-4 py-8">
                {error && (
                    <ErrorMessage
                        message={error}
                        onRetry={() => void loadExpenses()}
                    />
                )}
                <ExpenseUpload onUpload={handleUpload} loading={loadingUpload} />
                {importedExpenses.length > 0 && (
                    <section>
                        <h2 className="mb-4 text-lg font-semibold text-gray-900">
                            Resultado da importação
                        </h2>
                        <ExpenseTable expenses={importedExpenses} />
                    </section>
                )}
                <ExpenseFilters
                    filters={filters}
                    onChange={setFilters}
                    onSearch={() => void loadExpenses(filters)}
                    onClear={handleClearFilters}
                    loading={loadingList}
                />
                <section>
                    <h2 className="mb-4 text-lg font-semibold text-gray-900">
                        Despesas importadas
                    </h2>
                    <ExpenseTable expenses={expenses} loading={loadingList} />
                </section>
            </main>
        </div>
    )
}